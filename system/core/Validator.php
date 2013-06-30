<?php
/**
 *
 * Validator
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */

namespace Core;

class Validator
{
    private $input;

    private $errors = array();

    /**
     * Prepare the Validator, which has dependency on Core\Input
     * @param Input $input
     */
    public function __construct(Input $input)
    {
        $this->input = $input;
    }

    /**
     * Set the rules and return an instance of Validator
     * @param  array $rules form rules
     * @return Validator
     */
    public function create($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Validates the POST data by referring to the rules defined
     * @return boolean
     */
    public function valid()
    {
        foreach ($this->rules as $fieldName => $field)
        {
            foreach(explode('|', $field['rules']) as $rule)
            {
                $this->resolve($rule, $fieldName, $field['label']);
            }
        }

        if( empty($this->errors)) return TRUE;
        else return FALSE;
    }

    /**
     * Resolves the given rule and data if it passes or not
     * @param  string $rule
     * @param  mixed $data
     * @return boolean
     */
    private function resolve($rule, $fieldName, $label)
    {
        if($rule == 'required')
        {
            return $this->passesRequired($fieldName, $label);
        }

        if( FALSE !== strpos($rule, 'matches'))
        {
            $fieldMatch = '';

            // Get the field to match using RegEx
            preg_match_all("/\[(.*?)\]/", $rule, $fieldMatch);

            return $this->passesMatches($fieldMatch[1][0], $fieldName, $label);
        }
    }

    /**
     * Determines if data is missing or not
     * @param  mixed $data
     * @return boolean
     */
    private function passesRequired($field, $label)
    {
        if( ! $this->input->post($field))
        {
            $this->errors[] = "{$label} is required<br/>";

            return FALSE;
        }

        return TRUE;
    }

    /**
     * Determines if a field matches another field
     * @param  string $match field to match
     * @param  string $field field to validate
     * @param  mixed $data
     * @return
     */
    private function passesMatches($match, $field, $label)
    {
        if($this->input->post($match) != $this->input->post($field))
        {
            $this->errors[] = "{$label} does not match {$match}<br/>";
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Returns a string of all errors
     * @return string errors
     */
    public function getErrors()
    {
        $output = "";

        foreach($this->errors as $error)
        {
            $output .= $error;
        }

        return $output;
    }
}