<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct(){
        
    }

    public function get_data($fecha_inicio = null,$fecha_fin = null){
    	$query = $this->db->query('select deta.* ,
					leads.cf_852 as "Apartamento Cotizado",
					leads.cf_854 as "Proyecto",
					leads.cf_856 as "Visitó",
					leads.cf_858 as "Interacción",
					leads.cf_860 as "Estatus",
					leads.cf_862 as "Motivo de descarte",
					leads.cf_864 as "medio_generador",
					leads.cf_866 as "Enganche",
					leads.cf_868 as "Ingreso familiar",
					leads.cf_870 as "Cuota",
					leads.cf_872 as "Creacion prospecto",
					leads.cf_886 as "2do motivo de descarte",
					leads.cf_1000 as "ad name",
					leads.cf_1002 as "ad id",
					leads.cf_1004 as "campaign name",
					leads.cf_1006 as "campaign id",
					leads.cf_1008 as "Tareas planeadas",
					leads.cf_1010 as "Tareas en progreso",
					leads.cf_1012 as "Tareas completadas",
					leads.cf_1014 as "Agenda cita",
					leads.cf_1016 as "Confirma cita",
					leads.cf_1018 as "Ejecuta cita",
					leads.cf_1020 as "Reagenda cita",
					leads.cf_1022 as "Días interacción",
					leads.cf_1024 as "Fecha_de_ingreso",
					leads.cf_1026 as "Fecha_primera_tarea",
					leads.cf_1028 as "Hora que desea ser contactado",
					leads.cf_1142 as "Agenda cita SI",
					leads.cf_1144 as "Rectelefono",
					leads.cf_1152 as "z0NA 16",
					leads.cf_1154 as "Medio u hors de contacto",
					leads.cf_1156 as "Cuota Declarada 2",
					leads.cf_1158 as "Reserva"
					 from vtiger_leadscf leads
					inner join vtiger_leaddetails as deta on deta.leadid = leads.leadid
					 where date(leads.cf_1024) between date("'.$fecha_inicio.'") and date("'.$fecha_fin.'")  ;
					');
    	return $query->result();
    }
    public function get_leads_month($fecha_inicio = null,$fecha_fin = null){
    	$query = $this->db->query('select count(1) as cantidad,  year(leads.cf_1024) as anio,MONTH(leads.cf_1024) as mesr
			from vtiger_leadscf leads
			group by year(leads.cf_1024),MONTH(leads.cf_1024)
					 ;
					');
    	//where date(leads.cf_1024) between date("'.$fecha_inicio.'") and date("'.$fecha_fin.'")  
    	return $query->result();
    }
    public function gettipoactividad($fecha_inicio = null,$fecha_fin = null,$actividad=null){
    	$query = $this->db->query('select deta.* ,
					leads.cf_852 as "Apartamento Cotizado",
					leads.cf_854 as "Proyecto",
					leads.cf_856 as "Visitó",
					leads.cf_858 as "Interacción",
					leads.cf_860 as "Estatus",
					leads.cf_862 as "Motivo de descarte",
					leads.cf_864 as "Medio generador",
					leads.cf_866 as "Enganche",
					leads.cf_868 as "Ingreso familiar",
					leads.cf_870 as "Cuota",
					leads.cf_872 as "Creacion prospecto",
					leads.cf_886 as "2do motivo de descarte",
					leads.cf_1000 as "ad name",
					leads.cf_1002 as "ad id",
					leads.cf_1004 as "campaign name",
					leads.cf_1006 as "campaign id",
					leads.cf_1008 as "Tareas planeadas",
					leads.cf_1010 as "Tareas en progreso",
					leads.cf_1012 as "Tareas completadas",
					leads.cf_1014 as "Agenda cita",
					leads.cf_1016 as "Confirma cita",
					leads.cf_1018 as "Ejecuta cita",
					leads.cf_1020 as "Reagenda cita",
					leads.cf_1022 as "Días interacción",
					leads.cf_1024 as "Fecha de ingreso",
					leads.cf_1026 as "Fecha primera tarea",
					leads.cf_1028 as "Hora que desea ser contactado",
					leads.cf_1142 as "Agenda cita SI",
					leads.cf_1144 as "Rectelefono",
					leads.cf_1152 as "z0NA 16",
					leads.cf_1154 as "Medio u hors de contacto",
					leads.cf_1156 as "Cuota Declarada 2",
					leads.cf_1158 as "Reserva"
					 from vtiger_leadscf leads
					inner join vtiger_leaddetails as deta on deta.leadid = leads.leadid
					 where date(leads.cf_1024) between date("'.$fecha_inicio.'") and date("'.$fecha_fin.'")
					  and exists(
						select ac.activityid from vtiger_activity ac 
						left join vtiger_activitycf acf on ac.activityid = acf.activityid
						left join vtiger_seactivityrel acr on ac.activityid = acr.activityid
						-- join vtiger_crmentity
						   where acr.crmid = deta.leadid
                           and acf.cf_874 like "'.$actividad.'"
                          )
					   ;
					');
    	return $query->result();
    }
}