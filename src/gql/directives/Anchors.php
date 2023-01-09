<?php

namespace craft\anchors\gql\directives;

use craft\anchors\Plugin;
use craft\gql\base\Directive;
use craft\gql\GqlEntityRegistry;
use GraphQL\Language\DirectiveLocation;
use GraphQL\Type\Definition\Directive as GqlDirective;
use GraphQL\Type\Definition\FieldArgument;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

/**
 * Anchors GraphQL directive
 */
class Anchors extends Directive
{
    public static function create(): GqlDirective
    {
        if ($type = GqlEntityRegistry::getEntity(self::name())) {
            return $type;
        }

        return GqlEntityRegistry::createEntity(static::name(), new self([
            'name' => static::name(),
            'locations' => [
                DirectiveLocation::FIELD,
            ],
            'args' => [
                new FieldArgument([
                    'name' => 'tags',
                    'type' => Type::listOf(Type::string()),
                    'defaultValue' => ['h1', 'h2', 'h3'],
                    'description' => 'The tags to add anchor links to.',
                ]),
                new FieldArgument([
                    'name' => 'language',
                    'type' => Type::string(),
                    'defaultValue' => null,
                    'description' => 'The content language, used when converting non-ASCII characters to ASCII.',
                ]),
            ],
            'description' => 'Adds anchor links to the value.',
        ]));
    }

    public static function name(): string
    {
        return 'anchors';
    }

    public static function apply(mixed $source, mixed $value, array $arguments, ResolveInfo $resolveInfo): mixed
    {
        return Plugin::getInstance()->getParser()->parseHtml(
            (string)$value,
            $arguments['tags'] ?? 'h1,h2,h3',
            $arguments['language'] ?? null,
        );
    }
}
