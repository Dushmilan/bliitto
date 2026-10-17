<?php

/**
 * Guards the Blade port against silent drift from the approved legacy template.
 *
 * Each static page's body text (between the shared header/footer includes) must
 * still appear in the rendered page. Tags are stripped and whitespace collapsed
 * before comparison, so only the visible wording is checked.
 */

/** Pages whose body is static HTML, mapped to the legacy source file. */
$staticPages = [
    'about' => 'about.php',
    'services' => 'services.php',
    'tisc' => 'tisc.php',
    'consultancy' => 'consultancy.php',
    'ip-services' => 'ip-services.php',
    'patent-searches' => 'patent-searches.php',
    'industry' => 'industry.php',
    'patented-technologies' => 'patented-technologies.php',
    'technology-know-how' => 'technology-know-how.php',
    'researchers' => 'researchers.php',
    'centers' => 'centers.php',
    'downloads' => 'downloads.php',
    'submission' => 'submission.php',
];

function legacy_body(string $file): string
{
    $lines = file(base_path('legacy/'.$file));
    $start = $end = null;

    foreach ($lines as $i => $line) {
        if ($start === null && str_contains($line, 'includes/header.php')) {
            $start = $i;
        } elseif ($start !== null && str_contains($line, 'includes/footer.php')) {
            $end = $i;
            break;
        }
    }

    return implode('', array_slice($lines, $start + 1, $end - $start - 1));
}

function visible_text(string $html): string
{
    $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5);

    return trim(preg_replace('/\s+/', ' ', $text));
}

it('keeps the visible wording of every static page', function (string $route, string $file) {
    $rendered = visible_text($this->get(route($route))->getContent());
    $legacy = visible_text(legacy_body($file));

    expect($rendered)->toContain($legacy);
})->with(array_map(null, array_keys($staticPages), array_values($staticPages)));
