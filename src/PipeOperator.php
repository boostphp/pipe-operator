<?php

namespace Boost\PipeOperator;

class PipeOperator
{
    /**
     * The current value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Create a new class instance.
     *
     * @param  mixed  $value
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;

        if (! defined('PIPED_VALUE')) {
            define('PIPED_VALUE', 'PIPED_VALUE-'.uniqid());
        }
    }

    /**
     * Create a new class instance.
     *
     * @param  mixed  $value
     * @return self
     */
    public static function from($value): self
    {
        return new self($value);
    }

    /**
     * Dynamically call the piped function.
     *
     * @param  string  $name
     * @param  array  $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        if (! in_array(PIPED_VALUE, $arguments)) {
            $arguments = array_merge([PIPED_VALUE], $arguments);
        }

        return $this->pipe(function ($value) use ($name, $arguments) {
            foreach ($arguments as &$argument) {
                $argument = (($argument === PIPED_VALUE) ? $value : $argument);
            }

            return $name(...$arguments);
        });
    }

    /**
     * Execute the given callback on the current value.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function pipe(callable $callback): self
    {
        $this->value = $callback($this->value);

        return $this;
    }

    /**
     * Retrieve the current value.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->value;
    }
}
