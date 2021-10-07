<?php

namespace vendor;

class Paginator {

    private static $on_page = 7;

    public static function getNavigation($page, $total, $format, $on_page = 7) {

        if ($page > ceil($total / $on_page))
            $page = 1;

        $lim = ($page - 1) * $on_page;
        $nav = false;

        if ($total > $on_page) {
            $nav = '<ul class="pagination">' . self::navigation(7, $page, ceil($total / $on_page), $format) . '</ul>';
        }

        return array('lim' => $lim, 'on_page' => $on_page, 'navigation' => $nav);
    }

    private static function parseURLNavigation($str, $page) {

        $array_a = array("/page/{$page}/", "/page/{$page}", "#");

        return str_replace($array_a, "", $str);
    }

    private static function navigation($max, $page, $AllPages, $strURI) {

        $strReturn = "";
        $left = false;
        $right = false;
        $strURI = self::parseURLNavigation($strURI, $page);
        $page = (intval($page) > 0) ? intval($page) : 1;


        if ($AllPages <= $max) {
            for ($i = 1; $i <= $AllPages; $i++) {
                if ($i == $page) {
                    $strReturn .= '<li class="paginate_button page-item active"><a class="page-link" href="' . $strURI . $i . '" data-pjax>' . $page . '</a></li>';
                } else {
                    $strReturn .= '<li class="paginate_button page-item"><a class="page-link" href="' . $strURI . $i . '" data-pjax>' . $i . '</a> ';
                }
            }
        } else {
            for ($i = 1; $i <= $AllPages; $i++) {
                if ($i == $page OR ( $i == $page - 1) OR ( $i == $page - 2) OR ( $i == $page - 3) OR ( $i == $page - 4) OR ( $i == $page + 1) OR ( $i == $page + 2) OR ( $i == $page + 3) OR ( $i == $page + 4)) {
                    if ($i == $page) {
                        $strReturn .= '<li class="paginate_button page-item active"><a class="page-link" href="' . $strURI . $i . '" data-pjax>' . $page . '</a></li>';
                    } else {
                        $strReturn .= '<li class="paginate_button page-item"><a class="page-link" href="' . $strURI . $i . '" data-pjax>' . $i . '</a></li> ';
                    }  
                } else {
                    if ($i > $page) {
                        if (!$right) {
                            if ($page <= $AllPages - 6) {
                                $strReturn .= " <li class='paginate_button page-item'><a href=\"{$strURI}{$AllPages}\" data-pjax>{$AllPages}</a></li> ";
                                $right = true;
                            } else {
                                $strReturn .= " <li class='paginate_button page-item'><a href=\"{$strURI}{$AllPages}\" data-pjax>{$AllPages}</a></li> ";
                                $right = true;
                            }
                        }
                    } else {

                        if (!$left) {
                            if ($page > 6) {
                                $strReturn .= " <li class='paginate_button page-item'><a href=\"{$strURI}1\" data-pjax>1</a></li>";
                                $left = true;
                            } else {
                                $strReturn .= " <li class='paginate_button page-item'><a href=\"{$strURI}1\" data-pjax>1</a></li> ";
                                $left = true;
                            }
                        }
                    }
                }
            }
        }

        $left_str = '<li class="paginate_button page-item"><a class="page-link" href="' . $strURI . '" data-pjax>&laquo;</a></li> ';

        $right_str = ' <li class="paginate_button page-item"><a class="page-link" href="' . $strURI . ($page + 1) . '" data-pjax>&raquo;</a></li>';

        return $left_str . $strReturn . $right_str;
    }

}
