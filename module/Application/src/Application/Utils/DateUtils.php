<?php

namespace Application\Utils;

class DateUtils
{
    const DATE_FORMAT = 'd/m/Y';

    const YEAR_FORMAT = 'Y';

    const RELEASE_FORMAT = 'J M Y';

    /**
     * @return \DateTime
     */
    public static function getToday()
    {
        $date = new \DateTime();
        $date->setTime(0, 0, 0);
        return $date;
    }

    public static function dateToString(\DateTime $date = null, $format = DateUtils::DATE_FORMAT)
    {
        $result = '';
        if ($date != null) {
            $result = $date->format($format);
        }
        return $result;
    }







    public static function stringToDate($date)
    {
        $result = null;
        if (!empty($date)) {
            $result = \DateTime::createFromFormat(DateUtils::DATE_FORMAT, $date);
            if ($result) {
                $result->setTime(0, 0, 0);
            } else {
                $result = null;
            }
        }
        return $result;
    }


    /**
     * @param \DateTime $date
     * @param $nombreAnnees
     * @return \DateTime
     */
    public static function addAnneesToDate(\DateTime $date, $nombreAnnees)
    {
        $init = clone $date;
        if ($nombreAnnees == 0) {
            return $init;
        } else if ($nombreAnnees < 0) {
            $nombreAnnees = abs($nombreAnnees);
            return $init->sub(new \DateInterval('P' . $nombreAnnees . 'Y'));
        }
        return $init->add(new \DateInterval('P' . $nombreAnnees . 'Y'));
    }

    /**
     * @param \DateTime $date
     * @param $nombreMois
     * @return \DateTime
     */
    public static function addMoisToDate(\DateTime $date, $nombreMois)
    {
        $init = clone $date;
        if ($nombreMois == 0) {
            return $init;
        } else if ($nombreMois < 0) {
            $nombreMois = abs($nombreMois);
            return $init->sub(new \DateInterval('P' . $nombreMois . 'M'));
        }
        return $init->add(new \DateInterval('P' . $nombreMois . 'M'));
    }

    /**
     * @param \DateTime $date
     * @param $nombreJours
     * @return \DateTime
     */
    public static function addJoursToDate(\DateTime $date, $nombreJours)
    {
        $init = clone $date;
        if ($nombreJours == 0) {
            return $init;
        } else if ($nombreJours < 0) {
            $nombreJours = abs($nombreJours);
            return $init->sub(new \DateInterval('P' . $nombreJours . 'D'));
        }
        return $init->add(new \DateInterval('P' . $nombreJours . 'D'));
    }

    /**
     * @param \DateTime $date
     * @param $periodicite
     * @return \DateTime
     */
    public static function addOnePeriodiciteToDate(\DateTime $date, $periodicite)
    {
        $nombreMois = 0;
        switch ($periodicite) {
            case Periodicite::MENSUEL:
                $nombreMois = 1;
                break;
            case Periodicite::ANNUEL:
                $nombreMois = 12;
                break;
            case Periodicite::BIMESTRIEL:
                $nombreMois = 2;
                break;
            case Periodicite::SEMESTRIEL:
                $nombreMois = 6;
                break;
            case Periodicite::TRIMESTRIEL:
                $nombreMois = 3;
                break;
        }
        $init = clone $date;
        return $init->add(new \DateInterval('P' . $nombreMois . 'M'));
    }

    /**
     * @param \DateTime $date
     * @return int
     */
    public static function getJourFromDate(\DateTime $date)
    {
        $jour = date("j", $date->getTimestamp());
        return $jour;
    }

    /**
     * @param \DateTime $date
     * @return int
     */
    public static function getMoisFromDate(\DateTime $date)
    {
        $mois = date("n", $date->getTimestamp());
        return $mois;
    }

    /**
     * @param \DateTime $date
     * @return int
     */
    public static function getAnneeFromDate(\DateTime $date)
    {
        $annee = date("Y", $date->getTimestamp());
        return $annee;
    }

    /**
     * Retourne une date initialisée avec le jour mois annee : Attention on part de l'heure courante !!
     * @param $jour
     * @param $mois
     * @param $annee
     * @return \DateTime
     */
    public static function getNewDateFromJourMoisAnnee($jour, $mois, $annee)
    {
        $date = new \DateTime();
        if (empty($jour) || empty($mois) || empty($annee)) {
            return $date;
        }

        $date->setDate($annee, $mois, $jour);
        return $date;
    }

    /**
     * Retourne une date initialisée avec le jour mois annee et l'heure à Zero
     * @param $jour
     * @param $mois
     * @param $annee
     * @return \DateTime
     */
    public static function getNewDateFromJourMoisAnneeHeureZero($jour, $mois, $annee)
    {
        $date = DateUtils::getNewDateFromJourMoisAnnee($jour, $mois, $annee);
        $date->setTime(0, 0, 0);
        return $date;
    }


    /**
     * @param $mois
     * @param $annee
     * @return int
     */
    public static function getNombreDeJoursDansLeMoisEtAnnee($mois, $annee)
    {
        return cal_days_in_month(CAL_GREGORIAN, $mois, $annee);
    }

    /**
     * Retourne le dernier jour du mois de la date passée en paramètre.
     * @param \DateTime $date
     * @return int
     */
    public static function getDernierJourDuMois(\DateTime $date)
    {
        // on part de la $date que l'on porte au 01 du mois courant
        // on rajoute 1 mois à cette date, puis on retire 1j
        $iMois = DateUtils::getMoisFromDate($date);
        $iAnnee = DateUtils::getAnneeFromDate($date);
        $date = DateUtils::getNewDateFromJourMoisAnneeHeureZero(1, $iMois, $iAnnee);
        $date = DateUtils::addMoisToDate($date, 1);
        $date = DateUtils::addJoursToDate($date, -1);

        return DateUtils::getJourFromDate($date);
    }

    /**
     * Retourne la date correspondant au dernier jour du mois
     * @param \DateTime $date
     * @return \DateTime
     */
    public static function getDateDernierJourDuMois(\DateTime $date)
    {
        $idernJour = DateUtils::getDernierJourDuMois($date);
        $iMois = DateUtils::getMoisFromDate($date);
        $iAnnee = DateUtils::getAnneeFromDate($date);
        return DateUtils::getNewDateFromJourMoisAnneeHeureZero($idernJour, $iMois, $iAnnee);
    }

    /**
     * Retourne la date correspondante au Xieme jour du mois d'apres la date passée en parametre.
     * @param \DateTime $date
     * @param int $X
     * @return \DateTime
     */
    public static function getDateAuXiemeJourDuMoisDApres(\DateTime $date, $X)
    {
        $dateResult = clone $date;

        //Suite aux test unitaires : PB lorsque le mois d'apres à moins de jour que le mois courant :
        // getDateAuXiemeJourDuMoisDApres(31/01/2000) ramene 15/03/2000 !! en utilisant
        // date = DateUtils::addMoisToDate($date,1);
        // Mieux vaut rajouter 1 jour à la date du dernier jour du mois
        /** @var  $dateDernJourMois \DateTime */
        $dateDernJourMois = DateUtils::getDateDernierJourDuMois($dateResult);

        $dateResult = DateUtils::addJoursToDate($dateDernJourMois, 1);

        $iM = DateUtils::getMoisFromDate($dateResult);
        $iY = DateUtils::getAnneeFromDate($dateResult);
        $dateResult = DateUtils::getNewDateFromJourMoisAnneeHeureZero($X, $iM, $iY);

        return $dateResult;
    }


    /**
     * Ramène le nombre d'anniversaire entre la date passée en paramètre et aujourd'hui
     * @param \DateTime $date
     * @return int
     */

    /**
     * Ramène le nombre d'anniversaire entre la date passée en paramètre ($date) et $dateFrom
     * Si $dateFrom est null, prend la date du jour
     * NB : anniversaire en date réelle et non millésimée
     * @param \DateTime $date
     * @param null $dateFrom
     * @return mixed
     */
    public static function getNbAnniversaire(\DateTime $date, $dateFrom = null)
    {

        if (empty($dateFrom)) {
            $dateFrom = DateUtils::getToday();
        }
        $arr2 = explode('/', DateUtils::dateToString($date));
        $arr1 = explode('/', DateUtils::dateToString($dateFrom));


        if (($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
            return $arr2[2] - $arr1[2];

        return $arr2[2] - $arr1[2] - 1;
    }


    /**
     * Ramène le nombre d'années entre la date passée en paramètre
     * et selon les options entre la date du jour ou la date passée en option
     * array(
     *  'dateFrom' => DateUtils::getToday(),
     *  'millesime' => false, // age réel par defaut
     * ),
     * @param \DateTime $date
     * @param array $options
     * @return mixed
     */
    public static function getNombreDeAnnees(\DateTime $date, $options = array())
    {
        $options = array_merge(
            array(
                'dateFrom' => DateUtils::getToday(),
                'millesime' => false,
            ),
            $options
        );

        $dateFrom = $options['dateFrom'];
        $ageParMillesime = $options['millesime'];

        $arr2 = explode('/', DateUtils::dateToString($date));
        $arr1 = explode('/', DateUtils::dateToString($dateFrom));

        if ($ageParMillesime) {
            return $arr2[2] - $arr1[2];
        }

        if (($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
            return $arr2[2] - $arr1[2];


        return $arr2[2] - $arr1[2] - 1;
    }

    /**
     * @param \DateTime $date
     * @return mixed
     */
    public static function getAgeFromDateDeNaissance($date)
    {
        $date = empty($date) ? DateUtils::getToday() : $date;
        $dateFrom = DateUtils::getToday();
        $arr2 = explode('/', DateUtils::dateToString($dateFrom));
        $arr1 = explode('/', DateUtils::dateToString($date));
        return $arr2[2] - $arr1[2];
    }

    /**
     * @param $age
     * @return \DateTime|null
     */
    public static function getDateDeNaissanceFromAge($age)
    {
        return DateUtils::stringToDate(sprintf("01/01/%s", DateUtils::getAnneeDeNaissanceFromAge($age)));
    }

    /**
     * @param $age
     * @return mixed
     */
    public static function getAnneeDeNaissanceFromAge($age)
    {
        $dateFrom = DateUtils::getToday();
        $arr1 = explode('/', DateUtils::dateToString($dateFrom));
        $anneeDeNaissance = $arr1[2] - $age;
        return $anneeDeNaissance;
    }

    /**
     * Teste si la date est un 31 decembre
     * @param \DateTime $date
     * @return bool
     */
    public static function is3112(\DateTime $date = null)
    {
        return $date != null && DateUtils::getJourFromDate($date) == 31 && DateUtils::getMoisFromDate($date) == 12;
    }

    /**
     * Indique si les deux dates sont égales (sans prendre en compte les heures/minutes/secondes).
     * @param \DateTime $date1 une date.
     * @param \DateTime $date2 une date.
     * @return bool
     */
    public static function areEqual(\DateTime $date1, \DateTime $date2)
    {
        return (DateUtils::dateToString($date1) === DateUtils::dateToString($date2));
    }

}
