<?php
class test{
    public function test(){
        $criterias = array("dominio","criterio","tipo","alarma");
        echo"<pre>";
        $list = json_decode('[
                            {
                            "alarma": "Descripcion alarma1", "criterio": "Descripcion criterioA", "tipo": "DETENCION POR TIEMPO", "fecha": "2015-05-08 22:11:15",
                            "idhistorialalarma": 6027651, "dominio": "AAA 547", "idtto": 15, "alias": "A1", "idzona": 0, "zona": "zona1", "lat": "-32.49836", "lng": "-58.25439",
                            "estado": "Estado 1", "sentido": 265, "valor": "00:01:00", "velocidad": 15, "sucursal": "Sucursal 1"
                            },
                            {
                            "alarma": "Descripcion alarma2", "criterio": "Descripcion criterioB", "tipo": "DETENCION POR TIEMPO", "fecha": "2015-05-08 22:11:15",
                            "idhistorialalarma": 6027651, "dominio": "AAA 547", "idtto": 15, "alias": "A1", "idzona": 0, "zona": "zona1", "lat": "-32.49836", "lng": "-58.25439",
                            "estado": "Estado 1", "sentido": 265, "valor": "00:01:00", "velocidad": 15, "sucursal": "Sucursal 1"
                            },
                            {
                            "alarma": "Descripcion alarma3", "criterio": "Descripcion criterioC", "tipo": "VELOCIDAD MAXIMA EN ZONA", "fecha": "2015-05-08 22:11:15",
                            "idhistorialalarma": 6027651, "dominio": "BBB 547", "idtto": 10, "alias": "A2", "idzona": 0, "zona": "zona1", "lat": "-32.49836", "lng": "-58.25439",
                            "estado": "Estado 2", "sentido": 265, "valor": "00:01:00", "velocidad": 15, "sucursal": "Sucursal 1"
                            },
                            {
                            "alarma": "Descripcion alarma3", "criterio": "Descripcion criterioC", "tipo": "EVENTO", "fecha": "2015-05-08 22:11:15",
                            "idhistorialalarma": 6027651, "dominio": "BBB 5457", "idtto": 10, "alias": "A2", "idzona": 0, "zona": "zona1", "lat": "-32.49836", "lng": "-58.25439",
                            "estado": "Estado 2", "sentido": 265, "valor": "00:01:00", "velocidad": 15, "sucursal": "Sucursal 1"
                            }
                            ]',true); 
        $res = $this->groupBy($list,$criterias);
        print_r($res);
        echo"</pre>";
    }

    private function groupBy($list, $criterias) {
        $groups = array();
        if(!$criteria = array_shift($criterias))return;
        for ($i = 0; $i  < sizeof($list); $i++) {
            $obj = $list[$i];
            $val = $obj[$criteria];  
            $objOut = isset($groups[$val])?$groups[$val]:false;
            if (!$objOut) {
                $objOut = new stdClass();
                $objOut->children = array();
                $objOut->group = $val;
                $groups[$val] = $objOut; 
            } 
            $objOut->children[sizeof($objOut->children)] = $obj;
        }
        foreach($groups as &$gr){
             $gr->children = $this->groupBy($gr->children, $criterias);
        } 
        return $groups;
    }
} 
new test();
 
