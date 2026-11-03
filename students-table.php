<?php

declare(strict_types=1);

require_once('./config/Database.php');
require_once('./classes/Student.php');

$db = new Database();
$db->connect();

$limit = 5;
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$countRow = $db->selectRow("SELECT COUNT(*) AS total FROM students");
$totalStudents = isset($countRow['total']) ? (int)$countRow['total'] : 0;
$totalPages = (int)ceil($totalStudents / $limit);

$sql = "SELECT s.id, s.email, s.firstname, s.surname, s.street, s.city, s.zip, 
               r.name AS region_name, s.gender, s.note
        FROM students s
        INNER JOIN regions r ON s.region_id = r.id
        ORDER BY s.id ASC
        LIMIT $limit OFFSET $offset";

$statement = $db->selectData($sql);

$students = [];
if ($statement) {
    foreach ($statement as $row) {
        $students[] = new Student(
            (int)$row['id'],
            (string)$row['email'],
            (string)$row['firstname'],
            (string)$row['surname'],
            (string)$row['street'],
            (string)$row['city'],
            (string)$row['zip'],
            (string)$row['region_name'],
            (string)$row['gender'],
            (string)($row['note'] ?? '')
        );
    }
}

$db->closeConnection();

require_once('./html/htmlHead.php');
?>

    <h1 class="mt-5">Seznam studentů</h1>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Jméno</th>
            <th>Příjmení</th>
            <th>E-mail</th>
            <th>Adresa</th>
            <th>Kraj</th>
            <th>Pohlaví</th>
            <th>Poznámka</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($students)): ?>
            <tr>
                <td colspan="8" class="text-center">V databázi nejsou žádní studenti.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student->getId() ?></td>
                    <td><?= htmlspecialchars($student->getFirstname()) ?></td>
                    <td><?= htmlspecialchars($student->getSurname()) ?></td>
                    <td><?= htmlspecialchars($student->getEmail()) ?></td>
                    <td>
                        <?= htmlspecialchars($student->getStreet()) ?>,
                        <?= htmlspecialchars($student->getZip()) ?>
                        <?= htmlspecialchars($student->getCity()) ?>
                    </td>
                    <td><?= htmlspecialchars($student->getRegion()) ?></td>
                    <td><?= $student->getGender() === 'muz' ? 'Muž' : 'Žena' ?></td>
                    <td><?= nl2br(htmlspecialchars($student->getNote())) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

<?php if ($totalPages > 1): ?>
    <nav aria-label="Stránkování studentů">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>">Předchozí</a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($page === $i) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>">Další</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

<?php
require_once('./html/htmlFoot.php');
?>