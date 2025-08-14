<?php

function language_list (string ...$languages): array
{
    return $languages;
}

function add_to_language_list (array $language_list, string $newLanguage ): array
{
    $language_list[] = $newLanguage; 
    return $language_list;
}

function prune_language_list (array $language_list)
{
    return array_slice($language_list, 1);
}

function current_language (array $language_list)
    {
        return $language_list[0] ?? null;
    }

function language_list_length ( array $language_list)
    {
        return count($language_list);
    }