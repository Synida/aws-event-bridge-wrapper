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
 * @property string $jsonPath
 * @property string $output
 * @property string $region
 * @property string $command
 */
class EventBridge
{
    /**
     * Path of the json file that contains the event entries
     *
     * @var string
     */
    protected string $jsonPath;

    /**
     * This is where you can specify the output type
     *
     * @var string
     */
    protected string $output;

    /**
     * This is where you can specify the output type
     *
     * @var string
     */
    protected string $region;

    /**
     * Command string is stored here that is going to be executed
     *
     * @var string
     */
    protected string $command;

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

        $this->command = 'aws events put-events';

        // Returns with the path of the entries' parameter.
        $this->jsonPath = $this->getEntriesPath($options);

        $this->command .= " --entries {$this->jsonPath}";

        // Add region if specified
        $this->addRegion($options);

        // Adding output type if specified.
        $this->addOutput($options);
    }

    /**
     * Adding output type if specified.
     *
     * @param array $options
     * @return void
     * @author Synida Pry
     */
    public function addOutput(array $options): void
    {
        if (!isset($options['output'])) {
            return;
        }

        $this->command .= " --output {$options['output']}";
    }

    /**
     * Add region if specified
     *
     * @param array $options
     * @return void
     * @author Synida Pry
     */
    public function addRegion(array $options): void
    {
        if (!isset($options['region'])) {
            return;
        }

        $this->command .= " --region {$options['region']}";
    }

    /**
     * Executes the put-events command
     *
     * @return string|false|null
     * @author Synida Pry
     */
    public function putEvents()
    {
        return shell_exec($this->command);
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
        return (string)($options['entries']);
    }
}