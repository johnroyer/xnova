<?php

function ShowTechTreePage()
{
    global $resource, $requeriments, $LNG, $reslist, $USER, $PLANET;

    $PlanetRess = new ResourceUpdate();
    $PlanetRess->CalcResource();
    $PlanetRess->SavePlanetToDB();

    $template   = new template();
    $RequeriList = array();
    foreach ($LNG['tech'] as $Element => $ElementName) {
        if (!isset($resource[$Element])) {
            $TechTreeList[] = $ElementName;
        } else {
            $RequeriList    = array();
            if (isset($requeriments[$Element])) {
                foreach ($requeriments[$Element] as $RegID => $RedCount) {
                    $RequeriList[$Element][]    = array('id' => $RegID, 'count' => $RedCount, 'own' => (isset($PLANET[$resource[$RegID]])) ? $PLANET[$resource[$RegID]] : $USER[$resource[$RegID]]);
                }
            }

            $TechTreeList[] = array(
                'id'      => $Element,
                'name'    => $ElementName,
                'need'    => $RequeriList,
            );
        }
    }

    $template->assign_vars(array(
        'TechTreeList'      => $TechTreeList,
        'tt_requirements'   => $LNG['tt_requirements'],
        'LNG'               => $LNG['tech'],
        'tt_lvl'            => $LNG['tt_lvl'],
    ));

    $template->show("techtree_overview.tpl");
}
