<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day05\Range;
use Winkbrace\Advent2025\Day05\RangeMerger;

it('does not merge ranges that are not overlapping', function() {
    $merger = new RangeMerger();
    $merger->merge(new Range('10', '20'));
    $merger->merge(new Range('110', '120'));

    expect($merger->countFreshIds())->toBe(22);
});

it('merges ranges that are overlapping', function(Range $new, Range $expected) {
    $merger = new RangeMerger();
    $merger->merge(new Range('10', '20'));
    $merger->merge($new);

    expect($merger->ranges())->toHaveCount(1)
        ->and($merger->ranges()[0])->toEqual($expected);
})->with([
    ['new' => new Range('1', '10'),  'expected' => new Range('1', '20')],
    ['new' => new Range('10', '11'), 'expected' => new Range('10', '20')],
    ['new' => new Range('11', '12'), 'expected' => new Range('10', '20')],
    ['new' => new Range('19', '20'), 'expected' => new Range('10', '20')],
    ['new' => new Range('1', '100'), 'expected' => new Range('1', '100')],
]);

it('merges correctly with strings that are alphabetically sorted different from numeric', function() {
    $merger = new RangeMerger();
    $merger->merge(new Range('20', '30'));
    $merger->merge(new Range('29', '200')); // max should not stay 30

    expect($merger->ranges()[0])->toEqual(new Range('20', '200'));
});

it('should merge all overlapping ranges', function() {
    $merger = new RangeMerger();
    $merger->merge(new Range('10', '14'));
    $merger->merge(new Range('16', '20'));
    $merger->merge(new Range('12', '18'));

    expect($merger->ranges())->toHaveCount(1)
        ->and($merger->ranges()[0])->toEqual(new Range('10', '20'));
});
