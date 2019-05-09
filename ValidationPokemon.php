<?php
/**
 * Created by PhpStorm.
 * User: jozef.stasko
 * Date: 2019-05-02
 * Time: 19:06
 */
namespace ValidatorPokemon;
class ValidationPokemon
{
    /**
     * @param string $str
     * @return string
     */
    public static function ridOfWhiteSpacies(string $str): string
    {
        return preg_replace('/\s+/', ' ', $str);
    }

    /**
     * @param array $pokemonAttributes
     * @return array
     * @throws NotFoundException
     */
    public static function validationOfPokemon(array $pokemonAttributes): array
    {
        if (isset($pokemonAttributes['name']) && isset($pokemonAttributes['order'])
            && isset($pokemonAttributes['height']) && isset($pokemonAttributes['weight'])
            && isset($pokemonAttributes['sprites']['front_default'])) {
            return [
                'name' => $pokemonAttributes['name'],
                'pokedexNumber' => $pokemonAttributes['id'],
                'height' => $pokemonAttributes['height'],
                'weight' => $pokemonAttributes['weight'],
                'image' => $pokemonAttributes['sprites']['front_default']
            ];
        }
        throw new NotFoundException('Pokemon was not found');
    }
    public static function checkIfExistsEvolChain(array $evolution): array
    {
        $arr = [];
        $arr[] = isset($evolution['chain']['species']['name']) ? $evolution['chain']['species']['name']: null;
        $arr[] = isset($evolution['chain']['evolves_to'][0]['species']['name']) ? $evolution['chain']['evolves_to'][0]['species']['name']: null;
        $arr[] = isset($evolution['chain']['evolves_to'][0]['evolves_to'][0]['species']['name']) ?$evolution['chain']['evolves_to'][0]['evolves_to'][0]['species']['name'] : null;
        return $arr;
    }
    public static function getRidOfPokemonByName(array $arr, string $str): array
    {
        $newArr = [];
        foreach ($arr as $el) {
            if (strcmp($el, $str) !== 0) {
                $newArr[] = $el;
            }
        }
        return array_filter($newArr);
    }
    /**
     * @param array $abilities
     * @return array
     * @throws NotFoundException
     */
    public static function validationOfPokemonsAbilities(array $abilities): array
    {
        if (!empty($abilities)) {
            return $abilities;
        }
        throw new NotFoundException('Abilities dont exist');
    }
    /**
     * @param array $types
     * @return array
     * @throws NotFoundException
     */
    public static function validationOfPokemonsTypes(array $types): array
    {
        if (!empty($types)) {
            return $types;
        }
        throw new NotFoundException('Type doesnt exist');
    }
    /**
     * @param array $stats
     * @return array
     * @throws NotFoundException
     */
    public static function validationOfPokemonsStats(array $stats): array
    {
        if (!empty($stats)) {
            return $stats;
        }
        throw new NotFoundException('Stats dont exists');
    }
}
