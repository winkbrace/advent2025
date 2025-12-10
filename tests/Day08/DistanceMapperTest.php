<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day08\JunctionBox;
use Winkbrace\Advent2025\Day08\DistanceMapper;
use Winkbrace\Advent2025\InputReader;

beforeEach(function() {
    $input = InputReader::read('08', 'example');
    $this->mapper = new DistanceMapper($input);
});

it('sorts the junction boxes at construction', function () {
    expect($this->mapper->boxes)->toHaveCount(20)
        ->and((string) $this->mapper->boxes[0])->toBe('52,470,668 on #0')
        ->and((string) $this->mapper->boxes[19])->toBe('984,92,344 on #19');
});

it('finds the distance between two points in 3D space', function () {
    $a = JunctionBox::fromString('0,0,0', 0);
    $b = JunctionBox::fromString('3,4,5', 1);

    // √(3²+4²+5²) = 7.07106781
    expect((string) $this->mapper->calculateDistance($a, $b))->toBe('7.07106781');
});

it('creates the distance map', function () {
    $map = $this->mapper->buildDistanceMap();

    expect($map)->toHaveCount(190)
        ->and((string) $map[0])->toBe('162,817,812 on #3 to 425,690,689 on #7 = 316.90219311')
        ->and((string) $map[189])->toBe('216,146,977 on #4 to 819,987,18 on #14 = 1410.87596903');
});

it('connects closest junction boxes into circuit networks once', function() {
    $this->mapper->buildDistanceMap();
    $this->mapper->connectClosest(1);

    $circuits = $this->mapper->countCircuits()->all();
    expect($circuits)->toHaveCount(19)
        ->and($circuits[3])->toBe(2);
});

it('connects closest junction boxes into circuit networks twice', function() {
    $this->mapper->buildDistanceMap();
    $this->mapper->connectClosest(2);

    $circuits = $this->mapper->countCircuits()->all();
    expect($circuits)->toHaveCount(18)
        ->and($circuits[3])->toBe(3);
});

it('connects closest junction boxes into circuit networks three times', function() {
    $this->mapper->buildDistanceMap();
    $this->mapper->connectClosest(3);

    $circuits = $this->mapper->countCircuits()->all();
    expect($circuits)->toHaveCount(17)
        ->and($circuits[3])->toBe(3)
        ->and($circuits[13])->toBe(2);
});

it('The fourth closest are already connected, so the 5th closest should be connected', function() {
    $this->mapper->buildDistanceMap();
    $this->mapper->connectClosest(4);

    $circuits = $this->mapper->countCircuits()->all();
    expect($circuits)->toHaveCount(16)
        ->and($circuits[3])->toBe(3)
        ->and($circuits[13])->toBe(2)
        ->and($circuits[15])->toBe(2);
});

it('connects closest junction boxes into circuit networks 10 times', function() {
    $this->mapper->buildDistanceMap();
    $this->mapper->connectClosest(10);

    $circuits = $this->mapper->countCircuits()->all();
    expect($circuits)->toHaveCount(11)
        ->toBe([
            0 => 2,
            1 => 1,
            3 => 4,
            4 => 1,
            6 => 1,
            9 => 1,
            10 => 1,
            11 => 1,
            12 => 5,
            14 => 2,
            18 => 1,
        ]);
})->only();
