<?php

namespace Tests\OpenIDConnect\Metadata;

use OpenIDConnect\Metadata\MetadataTraits;
use Tests\TestCase;

class MetadataTraitTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnNewObjectWhenUsingWithMetadata(): void
    {
        /** @var MetadataTraits $target */
        $target = $this->getMockForTrait(MetadataTraits::class);

        $actual = $target->withMetadata('some', 'value');

        $this->assertNotSame($target, $actual);
        $this->assertSame('value', $actual->offsetGet('some'));
    }
}
