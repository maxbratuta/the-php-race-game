<?php

namespace App\Factories;

use ReflectionClass;
use ReflectionException;

/**
 * Class BaseFactory
 * @package App\Factories
 */
abstract class BaseFactory
{
    /**
     * The number of the factory iteration steps.
     *
     * @var int
     */
    protected int $step = 0;

    /**
     * The number of models that should be generated.
     *
     * @var int|null
     */
    private ?int $count;

    /**
     * The default namespace where factories reside.
     *
     * @var string
     */
    private static string $namespace = 'App\\Factories\\';

    /**
     * BaseFactory constructor.
     *
     * @param int|null $count
     */
    public function __construct(?int $count = null)
    {
        $this->count = $count;
    }

    /**
     * Get a new factory instance for the given model name.
     *
     * @param string $modelName
     * @return static
     */
    public static function factoryForModel(string $modelName): BaseFactory
    {
        $factory = self::getFactoryName($modelName);

        return new $factory();
    }

    /**
     * Create a new instance of the factory builder.
     *
     * @param int $count
     * @return static
     */
    public function make(int $count): BaseFactory
    {
        return new static(...array_values(['count' => $count]));
    }

    /**
     * Create an array of models.
     *
     * @return array
     */
    public function create(): array
    {
        return array_map(fn() => self::newModel($this->model, $this->definition()), range(1, $this->count));
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    abstract public function definition(): array;

    /**
     * Get the factory name for the given model name.
     *
     * @param string $modelName
     * @return string
     */
    private static function getFactoryName(string $modelName): string
    {
        try {
            $modelShortName = (new ReflectionClass($modelName))->getShortName();
        } catch (ReflectionException $e) {
            echo '⚠️Cannot get factory name. ' . $e->getMessage();
            die();
        }

        return self::$namespace . $modelShortName . 'Factory';
    }

    /**
     * Get a new model instance.
     *
     * @param string $model
     * @param array $attributes
     * @return mixed
     */
    private static function newModel(string $model, array $attributes = [])
    {
        return new $model(...array_values($attributes));
    }
}
