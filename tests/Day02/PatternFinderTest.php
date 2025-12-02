<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day02\PatternFinder;

describe('existsOfTwoRepeatedSequences', function() {
    it('should find one-digit pattern', function () {
        expect(PatternFinder::existsOfTwoRepeatedSequences('55'))->toBeTrue();
    });

    it('should find three-digit pattern', function () {
        expect(PatternFinder::existsOfTwoRepeatedSequences('123123'))->toBeTrue();
    });

    it('should not contain other digits', function () {
        expect(PatternFinder::existsOfTwoRepeatedSequences('12312345'))->toBeFalse();
    });
});

describe('existsOfRepeatedSequences', function() {
    it('should find one-digit pattern', function () {
        expect(PatternFinder::existsOfRepeatedSequences('5555'))->toBeTrue();
    });

    it('should find three-digit pattern', function () {
        expect(PatternFinder::existsOfRepeatedSequences('123123'))->toBeTrue();
    });

    it('should find multiple three-digit patterns', function () {
        expect(PatternFinder::existsOfRepeatedSequences('123123123'))->toBeTrue();
    });

    it('should not contain other digits', function () {
        expect(PatternFinder::existsOfRepeatedSequences('12312345'))->toBeFalse();
    });
});

// Whoops, this wasn't needed in the end
describe('containsRepeatedDigits', function() {
    it('should find one-digit pattern', function () {
        expect(PatternFinder::containsRepeatedDigits('55'))->toBeTrue();
    });

    it('should find one-digit pattern in a longer sequence', function () {
        expect(PatternFinder::containsRepeatedDigits('3557'))->toBeTrue();
    });

    it('the sequences must be neighbouring', function () {
        expect(PatternFinder::containsRepeatedDigits('353'))->toBeFalse();
    });

    it('should find two-digit pattern', function () {
        expect(PatternFinder::containsRepeatedDigits('3535'))->toBeTrue();
    });

    it('should find two-digit pattern inside a longer sequence', function () {
        expect(PatternFinder::containsRepeatedDigits('13535123'))->toBeTrue();
    });

    it('should not find two-digit pattern that are not neighbours', function () {
        expect(PatternFinder::containsRepeatedDigits('135935123'))->toBeFalse();
    });

    it('should find three-digit pattern', function () {
        expect(PatternFinder::containsRepeatedDigits('1345345'))->toBeTrue();
    });
});
