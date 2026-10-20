<?php
declare(strict_types=1);

function formatYoutubeUrl(string $url): string {
    return str_replace('watch?v=', 'embed/', $url);
}

function getWorkingDays(string $from, string $to): array {
    $days = [];
    for ($cur = strtotime($from), $end = strtotime($to); $cur <= $end; $cur = strtotime('+1 day', $cur)) {
        if (date('N', $cur) < 6) {
            $days[] = date('Y-m-d', $cur);
        }
    }
    return $days;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title>Úkol 2 – Demonstrace funkcí</title>
</head>
<body>

<h2>1. Testování funkce formatYoutubeUrl($url)</h2>
<?php
$urls = [
    'https://www.youtube.com/watch?v=Gl_Dnf_aGfQ',
    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'https://www.youtube.com/watch?v=OyYA8FlfBd0',
    'https://www.youtube.com/watch?v=s85iFQakA-U&list=RDs85iFQakA-U&start_radio=1'
];

foreach ($urls as $url) {
    echo "<p>Vstup: $url <br> Výstup: <b>" . formatYoutubeUrl($url) . "</b></p>";
}
?>

<h2>2. Testování funkce getWorkingDays($from, $to)</h2>
<pre>
<?php
echo "Interval 2024-10-17 až 2024-10-25:\n";
print_r(getWorkingDays('2024-10-17', '2024-10-25'));

echo "\nInterval 2024-10-01 až 2024-10-30:\n";
print_r(getWorkingDays('2024-10-01', '2024-10-30'));

echo "\nInterval 2024-11-15 až 2024-12-04:\n";
print_r(getWorkingDays('2024-11-15', '2024-12-04'));
?>
</pre>

</body>
</html>