<?php

namespace TheCodingMachine\TDBM\Dao;

use Porpaginas\Result;
use TheCodingMachine\TDBM\Test\Dao\Bean\CountryBean;
use TheCodingMachine\TDBM\Test\Dao\Generated\CountryBaseDao;

/**
 * The CountryDao class will maintain the persistence of CountryBean class into the country table.
 */
class TestCountryDao extends CountryBaseDao
{
    /**
     * @return CountryBean[]|Result
     */
    public function getCountriesByUserCount()
    {
        $sql = <<<SQL
SELECT country.*
FROM country
LEFT JOIN users ON users.country_id = country.id
GROUP BY country.id
ORDER BY COUNT(users.id) DESC
SQL;

        return $this->findFromRawSql($sql);
    }

    /**
     * @return CountryBean[]|Result
     */
    public function getCountriesUsingUnion()
    {
        $sql = <<<SQL
SELECT country.*
FROM country
WHERE country.id = 1
UNION
SELECT country.*
FROM country
WHERE country.id = 2
SQL;

        return $this->findFromRawSql($sql);
    }

    /**
     * @return CountryBean[]|Result
     */
    public function getCountriesUsingSimpleQuery()
    {
        $sql = <<<SQL
SELECT country.*
FROM country
WHERE country.id = 1
SQL;

        return $this->findFromRawSql($sql);
    }
}
