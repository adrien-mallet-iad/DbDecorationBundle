<?php

/*
 * The MIT License
 *
 * Copyright 2019 noobu.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Iad\Bundle\DbDecorationBundle\Decoration;

use Iad\Bundle\DbDecorationBundle\Faker\DecorateFakerInterface;

/**
 * Description of IbanDecoration
 *
 * @author noobu
 */
class IbanDecoration extends AbstractDecoration 
{
    const DECORATION_TYPE = [
        "iban",
    ];

    public function __construct(DecorateFakerInterface $faker)
    {
        $this->faker = $faker;
    }
    
    public function handleDecoration(string $type) { 
        
        if (in_array($type, self::DECORATION_TYPE)) {
            
            return $this->faker; 
        }
        
        parent::handleDecoration($type);
    }
    
    public function getHandleDecorationType(): array 
    { 
        return static::DECORATION_TYPE;
    }
}
