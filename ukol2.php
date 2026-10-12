<?php
declare(strict_types=1);


function formatYoutubeUrl(string $url): string {
    $queryString = parse_url($url, PHP_URL_QUERY);
    if ($queryString === null) {
        return $url;
    }

    parse_str($queryString, $queryParams);

    if (isset($queryParams['v']) && !empty($queryParams['v'])) {
        return 'https://www.youtube.com/embed/' . $queryParams['v'];
    }

    return $url;
}


function getWorkingDays(string $from, string $to): array {
    $workingDays = [];

    $currentDate = new DateTimeImmutable($from);
    $endDate = new DateTimeImmutable($to);


    if ($currentDate > $endDate) {
        return [];
    }

    while ($currentDate <= $endDate) {
        $dayOfWeek = (int)$currentDate->format('N');

        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
            $workingDays[] = $currentDate->format('Y-m-d');
        }

        $currentDate = $currentDate->modify('+1 day');
    }

    return $workingDays;
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title>Úkol 2 – Demonstrace funkcí</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; padding: 20px; max-width: 900px; margin: auto; }
        h2 { border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 30px; }
        pre { background: #f4f4f4; padding: 12px; border-radius: 6px; }
        .demo-box { margin-bottom: 20px; }
    </style>
</head>
<body>

<h1>Demonstrace funkcí </h1>

<h2>1. Testování funkce <code>formatYoutubeUrl($url)</code></h2>
<div class="demo-box">
    <?php
    $testUrls = [
        'https://www.youtube.com/watch?v=Gl_Dnf_aGfQ',
        'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'https://www.youtube.com/watch?v=LXb3EKWsInQ&t=42s',
        'https://www.youtube.com/watch?v=kffacxfA7G4'
    ];

    foreach ($testUrls as $url) {
        $embedUrl = formatYoutubeUrl($url);
        echo "<p>";
        echo "<strong>Vstup:</strong> " . htmlspecialchars($url) . "<br>";
        echo "<strong>Výstup:</strong> <code>" . htmlspecialchars($embedUrl) . "</code>";
        echo "</p>";
    }
    ?>
</div>

<h2>2. Testování funkce <code>getWorkingDays($from, $to)</code></h2>

<div class="demo-box">
    <h3>Interval 1 (ze zadání): 2024-10-17 až 2024-10-25</h3>
    <pre><?php print_r(getWorkingDays('2024-10-17', '2024-10-25')); ?></pre>
</div>

<div class="demo-box">
    <h3>Interval 2: 2024-10-01 až 2024-10-10</h3>
    <pre><?php print_r(getWorkingDays('2024-10-01', '2024-10-10')); ?></pre>
</div>

<div class="demo-box">
    <h3>Interval 3: 2024-11-15 až 2024-12-04</h3>
    <pre><?php print_r(getWorkingDays('2024-11-15', '2024-12-04')); ?></pre>
</div>

</body>
</html>