<?php
/**
 * Created by Synida Pry.
 * Copyright © 2022. All rights reserved.
 */

namespace synida\AwsEventBridgeWrapper;

use synida\AwsEventBridgeWrapper\exception\InvalidInputException;
use synida\AwsEventBridgeWrapper\validation\InputValidator;

/**
 * Class EventBridge
 * @package synida\AwsEventBridgeWrapper
 *
 * @property InputValidator $inputValidator
 */
class EventBridge
{
    /**
     * Input validator class
     *
     * @var InputValidator|null
     */
    protected ?InputValidator $inputValidator;

    /**
     * EventBridge constructor
     *
     * @param array $options
     * @throws InvalidInputException
     * @author Synida Pry
     */
    public function __construct(array $options)
    {
        $this->inputValidator = new InputValidator();

        // Validates the incoming input fields.
        $this->inputValidator->validateInput($options);

        // Returns with the path of the entries' parameter.
        $path = $this->getEntriesPath($options);

        shell_exec("aws events put-events --entries {$path}");
    }

        /**
         * Returns with the path of the entries' parameter.
         *
         * @param array $options
         * @return string
         * @author Synida Pry
         */
        protected function getEntriesPath(array $options): string
        {
            return (string)($options['path']);
        }
}