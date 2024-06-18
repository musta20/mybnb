<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('host.listings.update-listing');

    $component->assertSee('');
});
