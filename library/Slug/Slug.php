<?php
/**
 * Created by Artdevue.
 * User: artdevue - Slug.php
 * Date: 25.02.17
 * Time: 17:41
 * Project: phalcon-blank
 *
 * Class Slug  * @package Library\Slug
 */

namespace Library\Slug;

use Phalcon\Mvc\User\Component,
    Phalcon\Exception;

class Slug extends Component
{
    public static function alias ($alias, $maxlength = 255, $restrictchars = '')
    {
        $trans = array (
            '&'=>'and','%'=>'','\''=>'','À'=>'A','Â'=>'A','Ã'=>'A', 'Ä'=>'e','Å'=>'A','Æ'=>'e','Ā'=>'A','Ą'=>'A','Ă'=>'A',
            'Ç'=>'C','Ć'=>'C','Č'=>'C','Ĉ'=>'C','Ċ'=>'C','Ď'=>'D','Đ'=>'D','È'=>'E','È'=>'E',
            'É'=>'E','É'=>'E','Ê'=>'E','Ê'=>'E','Ë'=>'E','Ë'=>'E','Ē'=>'E','Ę'=>'E','Ě'=>'E','Ĕ'=>'E',
            'Ė'=>'E','Ĝ'=>'G','Ğ'=>'G','Ġ'=>'G','Ģ'=>'G','Ĥ'=>'H','Ħ'=>'H','Ì'=>'I','Ì'=>'I','Í'=>'I',
            'Í'=>'I','Î'=>'I','Î'=>'I','Ï'=>'I','Ï'=>'I','Ī'=>'I','Ĩ'=>'I','Ĭ'=>'I','Į'=>'I','İ'=>'I',
            'Ĳ'=>'J','Ĵ'=>'J','Ķ'=>'K','Ľ'=>'K','Ĺ'=>'K','Ļ'=>'K','Ŀ'=>'K','Ñ'=>'N','Ñ'=>'N','Ń'=>'N',
            'Ň'=>'N','Ņ'=>'N','Ŋ'=>'N','Ò'=>'O','Ò'=>'O','Ó'=>'O','Ó'=>'O','Ô'=>'O','Ô'=>'O','Õ'=>'O',
            'Õ'=>'O','Ö'=>'e','Ö'=>'e','Ø'=>'O','Ø'=>'O','Ō'=>'O','Ő'=>'O','Ŏ'=>'O','Œ'=>'E','Ŕ'=>'R',
            'Ř'=>'R','Ŗ'=>'R','Ś'=>'S','Ş'=>'S','Ŝ'=>'S','Ș'=>'S','Ť'=>'T','Ţ'=>'T','Ŧ'=>'T','Ț'=>'T',
            'Ù'=>'U','Ù'=>'U','Ú'=>'U','Ú'=>'U','Û'=>'U','Û'=>'U','Ü'=>'e','Ū'=>'U','Ü'=>'e','Ů'=>'U',
            'Ű'=>'U','Ŭ'=>'U','Ũ'=>'U','Ų'=>'U','Ŵ'=>'W','Ŷ'=>'Y','Ÿ'=>'Y','Ź'=>'Z','Ż'=>'Z','à'=>'a',
            'á'=>'a','â'=>'a','ã'=>'a','ä'=>'e','ä'=>'e','å'=>'a','ā'=>'a','ą'=>'a','ă'=>'a','å'=>'a',
            'æ'=>'e','ç'=>'c','ć'=>'c','č'=>'c','ĉ'=>'c','ċ'=>'c','ď'=>'d','đ'=>'d','è'=>'e','é'=>'e',
            'ê'=>'e','ë'=>'e','ē'=>'e','ę'=>'e','ě'=>'e','ĕ'=>'e','ė'=>'e','ƒ'=>'f','ĝ'=>'g','ğ'=>'g',
            'ġ'=>'g','ģ'=>'g','ĥ'=>'h','ħ'=>'h','ì'=>'i','í'=>'i','î'=>'i','ï'=>'i','ī'=>'i','ĩ'=>'i',
            'ĭ'=>'i','į'=>'i','ı'=>'i','ĳ'=>'j','ĵ'=>'j','ķ'=>'k','ĸ'=>'k','ł'=>'l','ľ'=>'l','ĺ'=>'l',
            'ļ'=>'l','ŀ'=>'l','ñ'=>'n','ń'=>'n','ň'=>'n','ņ'=>'n','ŉ'=>'n','ŋ'=>'n','ò'=>'o','ó'=>'o',
            'ô'=>'o','õ'=>'o','ö'=>'e','ö'=>'e','ø'=>'o','ō'=>'o','ő'=>'o','ŏ'=>'o','œ'=>'e','ŕ'=>'r',
            'ř'=>'r','ŗ'=>'r','ù'=>'u','ú'=>'u','û'=>'u','ü'=>'e','ū'=>'u','ü'=>'e','ů'=>'u','ű'=>'u',
            'ŭ'=>'u','ũ'=>'u','ų'=>'u','ŵ'=>'w','ÿ'=>'y','ŷ'=>'y','ż'=>'z','ź'=>'z','ß'=>'s','ſ'=>'s',
            'Α'=>'A','Ά'=>'A','Β'=>'B','Γ'=>'G','Δ'=>'D','Ε'=>'E','Έ'=>'E','Ζ'=>'Z','Η'=>'I','Ή'=>'I',
            'Θ'=>'TH','Ι'=>'I','Ί'=>'I','Ϊ'=>'I','Κ'=>'K','Λ'=>'L','Μ'=>'M','Ν'=>'N','Ξ'=>'KS','Ο'=>'O',
            'Ό'=>'O','Π'=>'P','Ρ'=>'R','Σ'=>'S','Τ'=>'T','Υ'=>'Y','Ύ'=>'Y','Ϋ'=>'Y','Φ'=>'F','Χ'=>'X',
            'Ψ'=>'PS','Ω'=>'O','Ώ'=>'O','α'=>'a','ά'=>'a','β'=>'b','γ'=>'g','δ'=>'d','ε'=>'e','έ'=>'e',
            'ζ'=>'z','η'=>'i','ή'=>'i','θ'=>'th','ι'=>'i','ί'=>'i','ϊ'=>'i','ΐ'=>'i','κ'=>'k','λ'=>'l',
            'μ'=>'m','ν'=>'n','ξ'=>'ks','ο'=>'o','ό'=>'o','π'=>'p','ρ'=>'r','σ'=>'s','τ'=>'t','υ'=>'y',
            'ύ'=>'y','ϋ'=>'y','ΰ'=>'y','φ'=>'f','χ'=>'x','ψ'=>'ps','ω'=>'o','ώ'=>'o','А'=>'a','Б'=>'b',
            'В'=>'v','Г'=>'g','Д'=>'d','Е'=>'e','Ё'=>'yo','Ж'=>'zh','З'=>'z','И'=>'i','Й'=>'j','К'=>'k',
            'Л'=>'l','М'=>'m','Н'=>'n','О'=>'o','П'=>'p','Р'=>'r','С'=>'s','Т'=>'t','У'=>'u','Ф'=>'f',
            'Х'=>'x','Ц'=>'cz','Ч'=>'ch','Ш'=>'sh','Щ'=>'shh','Ъ'=>'','Ы'=>'yi','Ь'=>'','Э'=>'e','Ю'=>'yu',
            'Я'=>'ya','а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh','з'=>'z',
            'и'=>'i','й'=>'j','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s',
            'т'=>'t','у'=>'u','ф'=>'f','х'=>'x','ц'=>'cz','ч'=>'ch','ш'=>'sh','щ'=>'shh','ъ'=>'','ы'=>'yi',
            'ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya'
        );

        $alias = strip_tags(strtr($alias,$trans));
        $alias = str_replace('&', ' and ', $alias);
        $alias = preg_replace('/&.+?;/', '', $alias);
        $alias = str_replace(array('  ','&nbsp;&nbsp;'), '-', $alias);
        $alias = str_replace('&nbsp;', '-', $alias);
        /* restrict characters as configured */
        switch ($restrictchars) {
            case 'alphanumeric':
                /* restrict alias to alphanumeric characters only */
                $alias = preg_replace('/[^\.%A-Za-z0-9 _-]/', '', $alias);
                break;
            case 'alpha':
                /* restrict alias to alpha characters only */
                $alias = preg_replace('/[^\.%A-Za-z _-]/', '', $alias);
                break;
            case 'legal':
            default:
                /* restrict alias to legal URL characters only */
                $alias = preg_replace('/[\0\x0B\t\n\r\f\a&=+%#<>"~`@\?\[\]\{\}\|\^\'\\\\]/', '', $alias);
        }
        /* replace one or more space characters with word delimiter */
        $alias = preg_replace('/\s+/u', '-', $alias);
        /* otherwise, just use strtolower */
        $alias = strtolower($alias);
        /* trim specified chars from both ends of the alias */
        $alias = trim($alias, '/.-');

        $alias = preg_replace("/[^a-zA-Z0-9-]/","",$alias);
        $alias = preg_replace('/([-]){2,}/', '\1',$alias);
        $alias = trim($alias, '-');

        /* if maxlength is specified and exceeded, return substr with additional trim applied */
        if ($maxlength > 0 && strlen($alias) > $maxlength) {
            $alias = substr($alias, 0, $maxlength);
            $alias = trim($alias, '/.-');
        }

        return $alias;
    }

    /**
     * Обрезка строки по кол-ву слов
     *
     * @param        $input_text Входная строка
     * @param int    $limit      Кол-во слов на выходе
     * @param string $end_str    Окончание
     *
     * @return string
     */
    public function words_limit($input_text, $limit = 50, $end_str = '...') {
        $input_text = strip_tags($input_text);
        $words = explode(' ', $input_text);
        if ($limit < 1 || sizeof($words) <= $limit) {
            return $input_text;
        }
        $words = array_slice($words, 0, $limit);
        $out = implode(' ', $words);

        return $out . $end_str;
    }

    /**
     * Обрезка строки по кол-ву букв с возвротом целого слова
     *
     * @param        $input_text Входная строка
     * @param int    $limit      Кол-во букв на выходе
     * @param string $end_str    Окончание
     *
     * @return string
     */
    public function letter_limit($input_text, $limit = 250, $end_str = '...') {
        $input_text = strip_tags($input_text);
        if ($limit < 1 || strlen($input_text) <= $limit) {
            return $input_text;
        }

        $len = (mb_strlen($input_text) > $limit)
            ? mb_strripos(mb_substr($input_text, 0, $limit), ' ')
            : $limit
        ;
        $cutStr = mb_substr($input_text, 0, $len);
        $cutStr = str_replace(array('&nbsp;', '&#160;', '¶'), ' ', $cutStr);
        return (mb_strlen($input_text) > $limit)
            ? $cutStr . ' ' . $end_str
            : $cutStr
            ;
    }

    public function plural_form($n, $forms) {
        return $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
    }
}