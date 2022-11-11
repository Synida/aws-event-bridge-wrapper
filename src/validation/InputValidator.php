<?php
/**
 * Created by Synida Pry.
 * Copyright © 2022. All rights reserved.
 */

namespace synida\AwsEventBridgeWrapper\validation;

use synida\AwsEventBridgeWrapper\exception\InvalidInputException;

/**
 * Class InputValidator
 */
class InputValidator
{
    /**
     * Validates the incoming input fields.
     *
     * @param array $options
     * @return void
     * @throws InvalidInputException
     * @author Synida Pry
     */
    public function validateInput(array $options): void
    {
        if (!isset($options['entries']) || !file_exists($options['entries'])) {
            throw new InvalidInputException('entries parameter must be sent');
        }
    }
}