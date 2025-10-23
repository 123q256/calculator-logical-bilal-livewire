<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class Chemistry extends Model
{
    public $param;

    // Ideal Gas Law Calculator
    public function gas($request){
		if(is_numeric($request->x) && is_numeric($request->y) && is_numeric($request->z)){
			if ($request->method==='press') {
				$volum=$request->x;
				if ($request->x_v_unit==='cm³') {
					$volum=$volum / 1e+6;
				}
				if ($request->x_v_unit==='mm³') {
					$volum=$volum / 1e+9;
				}
				if ($request->x_v_unit==='dm³') {
					$volum=$volum / 1000;
				}
				if ($request->x_v_unit==='ft³') {
					$volum=$volum / 35.315;
				}
				if ($request->x_v_unit==='in³') {
					$volum=$volum / 61024;
				}
				$temp=$request->z;
				if ($request->z_t_unit==='°C') {
					$temp=$temp + 273.15;
				}
				if ($request->z_t_unit==='°F') {
					$temp=($temp - 32) * 5/9 + 273.15;
				}
				$amount=$request->y;
				if ($request->y_s_unit==='μmol') {
					$amount=$amount / 1e+6;
				}
				if ($request->y_s_unit==='mmol') {
					$amount=$amount / 1000;
				}
				$ans=round(($amount * $request->R * $temp) / $volum,3)." Pascal";
				$ans1=round(($amount * $request->R * $temp) / $volum,3);
			}
			if ($request->method=='volume') {
				$temp=$request->x;
				if ($request->x_t_unit==='°C') {
					$temp=$temp + 273.15;
				}
				if ($request->x_t_unit==='°F') {
					$temp=($temp - 32) * 5/9 + 273.15;
				}
				$amount=$request->y;
				if ($request->y_s_unit==='μmol') {
					$amount=$amount / 1e+6;
				}
				if ($request->y_s_unit==='mmol') {
					$amount=$amount / 1000;
				}
				$press=$request->z;
				if ($request->z_p_unit==='psi') {
					$press=$press * 6894.757;
				}
				if ($request->z_p_unit==='bar') {
					$press=$press * 100000;
				}
				if ($request->z_p_unit==='atm') {
					$press=$press * 101325;
				}
				if ($request->z_p_unit==='at') {
					$press=$press * 98067;
				}
				if ($request->z_p_unit==='Torr' || $request->z_p_unit=='mmHg') {
					$press=$press * 133.322;
				}
				if ($request->z_p_unit==='kPa') {
					$press=$press * 1000;
				}
				$ans=round(($amount * $request->R * $temp) / $press,5)." m³";
				$ans1=round(($amount * $request->R * $temp) / $press,5);
			}
			if ($request->method==='temp') {
				$volum=$request->x;
				if ($request->x_v_unit==='cm³') {
					$volum=$volum / 1e+6;
				}
				if ($request->x_v_unit==='ft³') {
					$volum=$volum / 35.315;
				}
				if ($request->x_v_unit==='dm³') {
					$volum=$volum / 1000;
				}
				if ($request->x_v_unit==='ft³') {
					$volum=$volum / 35.315;
				}
				if ($request->x_v_unit==='in³') {
					$volum=$volum / 61024;
				}
				$amount=$request->y;
				if ($request->y_s_unit==='μmol') {
					$amount=$amount / 1e+6;
				}
				if ($request->y_s_unit==='mmol') {
					$amount=$amount / 1000;
				}
				$press=$request->z;
				if ($request->z_p_unit==='psi') {
					$press=$press * 6894.757;
				}
				if ($request->z_p_unit==='bar') {
					$press=$press * 100000;
				}
				if ($request->z_p_unit==='atm') {
					$press=$press * 101325;
				}
				if ($request->z_p_unit==='at') {
					$press=$press * 98067;
				}
				if ($request->z_p_unit==='Torr' || $request->z_p_unit=='mmHg') {
					$press=$press * 133.322;
				}
				if ($request->z_p_unit==='kPa') {
					$press=$press * 1000;
				}
				$ans=round(($press * $volum) / ($request->R * $amount),5)." Kelvin";
                $ans1=round(($press * $volum) / ($request->R * $amount),5);
			}
			if ($request->method==='sub') {
				$volum=$request->x;
				if ($request->x_v_unit==='cm³') {
					$volum=$volum / 1e+6;
				}
				if ($request->x_v_unit==='ft³') {
					$volum=$volum / 35.315;
				}
				if ($request->x_v_unit==='dm³') {
					$volum=$volum / 1000;
				}
				if ($request->x_v_unit==='ft³') {
					$volum=$volum / 35.315;
				}
				if ($request->x_v_unit==='in³') {
					$volum=$volum / 61024;
				}
				$press=$request->y;
				if ($request->y_p_unit==='psi') {
					$press=$press * 6894.757;
				}
				if ($request->y_p_unit==='bar') {
					$press=$press * 100000;
				}
				if ($request->y_p_unit==='atm') {
					$press=$press * 101325;
				}
				if ($request->y_p_unit==='at') {
					$press=$press * 98067;
				}
				if ($request->y_p_unit==='Torr' || $request->y_p_unit=='mmHg') {
					$press=$press * 133.322;
				}
				if ($request->y_p_unit==='kPa') {
					$press=$press * 1000;
				}
				$temp=$request->z;
				if ($request->z_t_unit==='°C') {
					$temp=$temp + 273.15;
				}
				if ($request->z_t_unit==='°F') {
					$temp=($temp - 32) * 5/9 + 273.15;
				}
				$ans=round(($press * $volum) / ($request->R * $temp),5)." mol";
                $ans1=round(($press * $volum) / ($request->R * $temp),5);
			}
			$this->param['ans'] = $ans;
			$this->param['ans1'] = $ans1;
			$this->param['RESULT'] = 1;
            return $this->param;
		}else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
		}
	}

    // Mole Fraction Calculator
    public function mole_frac($request){
		//  dd($request->all());
		if (is_numeric($request->x) && is_numeric($request->y) && empty($request->z) && empty($request->a)) {
			if ($request->unit_x==='Gram' && !is_numeric($request->divide_x)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			if ($request->unit_y==='Gram' && !is_numeric($request->divide_y)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			$Solute=$request->x;
			if ($request->unit_x==='Gram') {
				$Solute=$Solute/$request->divide_x;
			}
			if ($request->unit_x==='Millimole') {
				$Solute=$Solute / 1000;
			}
			if ($request->unit_x==='Kilomole') {
				$Solute=$Solute * 1000;
			}
			if ($request->unit_x==='Kilomole') {
				$Solute=$Solute * 1000;
			}
			if ($request->unit_x==='PoundMole') {
				$Solute=$Solute * 9.223e+18;
			}
			$Solvent=$request->y;
			if ($request->unit_y==='Gram') {
				$Solvent=$Solvent/$request->divide_y;
			}
			if ($request->unit_y==='Millimole') {
				$Solvent=$Solvent / 1000;
			}
			if ($request->unit_y==='Kilomole') {
				$Solvent=$Solvent * 1000;
			}
			if ($request->unit_y==='Kilomole') {
				$Solvent=$Solvent * 1000;
			}
			if ($request->unit_y==='PoundMole') {
				$Solvent=$Solvent * 9.223e+18;
			}
			$mol=round($Solute / ($Solute + $Solvent),5);
			$sol=round($Solute + $Solvent,5);
			$this->param['RESULT'] = 1;
			$this->param['Solute'] = $Solute;
			$this->param['Solvent'] = $Solvent;
			$this->param['sol'] = $sol;
			$this->param['mol'] = $mol;

            return $this->param;
		}elseif (is_numeric($request->x) && is_numeric($request->z) && empty($request->y) && empty($request->a)) {
			if ($request->unit_z==='Gram' && !is_numeric($request->divide_z)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			if ($request->unit_x==='Gram' && !is_numeric($request->divide_x)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			$Solute=$request->x;
			if ($request->unit_x==='Gram') {
				$Solute=$Solute/$request->divide_x;
			}
			if ($request->unit_x==='Millimole') {
				$Solute=$Solute / 1000;
			}
			if ($request->unit_x==='Kilomole') {
				$Solute=$Solute * 1000;
			}
			if ($request->unit_x==='Kilomole') {
				$Solute=$Solute * 1000;
			}
			if ($request->unit_x==='PoundMole') {
				$Solute=$Solute * 9.223e+18;
			}
			$sol=$request->z;
			if ($request->unit_z==='Gram') {
				$sol=$sol/$request->divide_z;
			}
			if ($request->unit_z==='Millimole') {
				$sol=$sol / 1000;
			}
			if ($request->unit_z==='Kilomole') {
				$sol=$sol * 1000;
			}
			if ($request->unit_z==='Kilomole') {
				$sol=$sol * 1000;
			}
			if ($request->unit_z==='PoundMole') {
				$sol=$sol * 9.223e+18;
			}
			$Solvent=$sol-$Solute;
			$mol=round($Solute / ($Solute + $Solvent),5);
			$this->param['RESULT'] = 1;
			$this->param['Solute'] = $Solute;
			$this->param['Solvent'] = $Solvent;
			$this->param['sol'] = $sol;
			$this->param['mol'] = $mol;

            return $this->param;
		}elseif (is_numeric($request->x) && is_numeric($request->a) && empty($request->y) && empty($request->z)) {
			if ($request->unit_x==='Gram' && !is_numeric($request->divide_x)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			if ($request->unit_a==='Gram' && !is_numeric($request->divide_a)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			$Solute=$request->x;
			if ($request->unit_x==='Gram') {
				$Solute=$Solute/$request->divide_x;
			}
			if ($request->unit_x==='Millimole') {
				$Solute=$Solute / 1000;
			}
			if ($request->unit_x==='Kilomole') {
				$Solute=$Solute * 1000;
			}
			if ($request->unit_x==='Kilomole') {
				$Solute=$Solute * 1000;
			}
			if ($request->unit_x==='PoundMole') {
				$Solute=$Solute * 9.223e+18;
			}
			if ($request->unit_z==='PoundMole') {
				$Solute=$Solute * 9.223e+18;
			}
			$mol=$request->a;
			if ($request->unit_a==='Gram') {
				$mol=$mol/$request->divide_a;
			}
			if ($request->unit_a==='Millimole') {
				$mol=$mol / 1000;
			}
			if ($request->unit_a==='Kilomole') {
				$mol=$mol * 1000;
			}
			if ($request->unit_a==='Kilomole') {
				$mol=$mol * 1000;
			}
			if ($request->unit_a==='PoundMole') {
				$mol=$mol * 9.223e+18;
			}
			$Solvent=round((($Solute / $mol) - $Solute),2);
			$sol=round($Solute + $Solvent,2);
			$this->param['RESULT'] = 1;
			$this->param['Solute'] = $Solute;
			$this->param['Solvent'] = $Solvent;
			$this->param['sol'] = $sol;
			$this->param['mol'] = $mol;

            return $this->param;
		}elseif (is_numeric($request->y) && is_numeric($request->z) && empty($request->x) && empty($request->a)) {
			if ($request->unit_z==='Gram' && !is_numeric($request->divide_z)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			if ($request->unit_y==='Gram' && !is_numeric($request->divide_y)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			$sol=$request->z;
			if ($request->unit_z==='Gram') {
				$sol=$sol/$request->divide_z;
			}
			if ($request->unit_z==='Millimole') {
				$sol=$sol / 1000;
			}
			if ($request->unit_z==='Kilomole') {
				$sol=$sol * 1000;
			}
			if ($request->unit_z==='Kilomole') {
				$sol=$sol * 1000;
			}
			if ($request->unit_z==='PoundMole') {
				$sol=$sol * 9.223e+18;
			}
			$Solvent=$request->y;
			if ($request->unit_y==='Gram') {
				$Solvent=$Solvent/$request->divide_y;
			}
			if ($request->unit_y==='Millimole') {
				$Solvent=$Solvent / 1000;
			}
			if ($request->unit_y==='Kilomole') {
				$Solvent=$Solvent * 1000;
			}
			if ($request->unit_y==='Kilomole') {
				$Solvent=$Solvent * 1000;
			}
			if ($request->unit_y==='PoundMole') {
				$Solvent=$Solvent * 9.223e+18;
			}
			$Solute=$sol-$Solvent;
			$mol=round($Solute / ($Solute + $Solvent),5);
			$this->param['RESULT'] = 1;
			$this->param['Solute'] = $Solute;
			$this->param['Solvent'] = $Solvent;
			$this->param['sol'] = $sol;
			$this->param['mol'] = $mol;

            return $this->param;
		}elseif (is_numeric($request->y) && is_numeric($request->a) && empty($request->x) && empty($request->z)) {
			if ($request->unit_a==='Gram' && !is_numeric($request->divide_a)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			if ($request->unit_y==='Gram' && !is_numeric($request->divide_y)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			$Solvent=$request->y;
			if ($request->unit_y==='Gram') {
				$Solvent=$Solvent/$request->divide_y;
			}
			if ($request->unit_y==='Millimole') {
				$Solvent=$Solvent / 1000;
			}
			if ($request->unit_y==='Kilomole') {
				$Solvent=$Solvent * 1000;
			}
			if ($request->unit_y==='Kilomole') {
				$Solvent=$Solvent * 1000;
			}
			if ($request->unit_y==='PoundMole') {
				$Solvent=$Solvent * 9.223e+18;
			}
			$mol=$request->a;
			if ($request->unit_a==='Gram') {
				$mol=$mol/$request->divide_a;
			}
			if ($request->unit_a==='Millimole') {
				$mol=$mol / 1000;
			}
			if ($request->unit_a==='Kilomole') {
				$mol=$mol * 1000;
			}
			if ($request->unit_a==='Kilomole') {
				$mol=$mol * 1000;
			}
			if ($request->unit_a==='PoundMole') {
				$mol=$mol * 9.223e+18;
			}
			$Solute=round((($mol * $Solvent)*(-1)) / ($mol - 1),3);
			$sol=$Solute+$Solvent;
			$this->param['RESULT'] = 1;
			$this->param['Solute'] = $Solute;
			$this->param['Solvent'] = $Solvent;
			$this->param['sol'] = $sol;
			$this->param['mol'] = $mol;

            return $this->param;
		}elseif (is_numeric($request->z) && is_numeric($request->a) && empty($request->x) && empty($request->y)) {
			if ($request->unit_a==='Gram' && !is_numeric($request->divide_a)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			if ($request->unit_z==='Gram' && !is_numeric($request->divide_z)) {
                $this->param['error'] = 'Please enter gram value too.';
                return $this->param;
			}
			$mol=$request->a;
			if ($request->unit_a==='Gram') {
				$mol=$mol/$request->divide_a;
			}
			if ($request->unit_a==='Millimole') {
				$mol=$mol / 1000;
			}
			if ($request->unit_a==='Kilomole') {
				$mol=$mol * 1000;
			}
			if ($request->unit_a==='Kilomole') {
				$mol=$mol * 1000;
			}
			if ($request->unit_a==='PoundMole') {
				$mol=$mol * 9.223e+18;
			}
			$sol=$request->z;
			if ($request->unit_z==='Gram') {
				$sol=$sol/$request->divide_z;
			}
			if ($request->unit_z==='Millimole') {
				$sol=$sol / 1000;
			}
			if ($request->unit_z==='Kilomole') {
				$sol=$sol * 1000;
			}
			if ($request->unit_z==='Kilomole') {
				$sol=$sol * 1000;
			}
			if ($request->unit_z==='PoundMole') {
				$sol=$sol * 9.223e+18;
			}
			$Solute=round($sol*$mol,3);
			$Solvent=$sol-$Solute;
			$this->param['RESULT'] = 1;
			$this->param['Solute'] = $Solute;
			$this->param['Solvent'] = $Solvent;
			$this->param['sol'] = $sol;
			$this->param['mol'] = $mol;

            return $this->param;
		}else{
            $this->param['error'] = 'Please fill any two fields.';
            return $this->param;
		}
	}

    // Percent Yield Calculator
	public function percent_yield($request){
		if ($request->method==='1') {
			if (is_numeric($request->x) && is_numeric($request->y)) {
				$actual=$request->y;
				if ($request->unit_y==='µg') {
					$actual=$actual / 1e+6;
				}
				if ($request->unit_y==='mg') {
					$actual=$actual / 1000;
				}
				if ($request->unit_y==='kg') {
					$actual=$actual * 1000;
				}
				if ($request->unit_y==='lbs') {
					$actual=$actual * 454;
				}
				$ther=$request->x;
				if ($request->unit_x==='µg') {
					$ther=$ther / 1e+6;
				}
				if ($request->unit_x==='mg') {
					$ther=$ther / 1000;
				}
				if ($request->unit_x==='kg') {
					$ther=$ther * 1000;
				}
				if ($request->unit_x==='lbs') {
					$ther=$ther * 454;
				}
				$ans= round(($actual/$ther)*100,2);
				$this->param['RESULT'] = 1;
				$this->param['ans'] = $ans;
                return $this->param;
			}else{
                $this->param['error'] = 'Please Fill All Fields.';
                return $this->param;
			}
		}
		if ($request->method==='2') {
			if (is_numeric($request->z) && is_numeric($request->y)) {
				$actual=$request->y;
				if ($request->unit_y==='µg') {
					$actual=$actual / 1e+6;
				}
				if ($request->unit_y==='mg') {
					$actual=$actual / 1000;
				}
				if ($request->unit_y==='kg') {
					$actual=$actual * 1000;
				}
				if ($request->unit_y==='lbs') {
					$actual=$actual * 454;
				}
				$percent=$request->z;
				$ans= round(($actual/$percent)*100,2);
				$this->param['RESULT'] = 1;
				$this->param['ans'] = $ans;
                return $this->param;
			} else {
                $this->param['error'] = 'Please Fill All Fields.';
                return $this->param;
			}
			
		}
		if ($request->method==='3') {
			if (is_numeric($request->z) && is_numeric($request->y)) {
				$actual=$request->y;
				if ($request->unit_y==='µg') {
					$actual=$actual / 1e+6;
				}
				if ($request->unit_y==='mg') {
					$actual=$actual / 1000;
				}
				if ($request->unit_y==='kg') {
					$actual=$actual * 1000;
				}
				if ($request->unit_y==='lbs') {
					$actual=$actual * 454;
				}
				$percent=$request->z;
				$ans= round(($actual*$percent)/100,2);
				$this->param['RESULT'] = 1;
				$this->param['ans'] = $ans;
                return $this->param;
			} else {
                $this->param['error'] = 'Please Fill All Fields.';
                return $this->param;
			}
		}
	}

    // Theoretical Yield Calculator
	public function theoretical($request){
		if (is_numeric($request->lx) && is_numeric($request->ly) && is_numeric($request->dx) && is_numeric($request->dy) && is_numeric($request->sx)) {
			$put_input['lx']=$request->lx;
			$put_input['ly']=$request->ly;
			$put_input['dx']=$request->dx;
			$put_input['dy']=$request->dy;
			$put_input['sx']=$request->sx;
			$mass=$request->lx;
			if ($request->unit_x==='µg') {
				$mass=$mass / 1e+6;
			}
			if ($request->unit_x==='mg') {
				$mass=$mass / 1000;
			}
			if ($request->unit_x==='kg') {
				$mass=$mass * 1000;
			}
			if ($request->unit_x==='lbs') {
				$mass=$mass * 454;
			}
			$mole=round($mass / $request->ly,2);
			$ans=round($request->dx * $request->dy,2);
			$st=round($request->dx*($request->sx/$mole),2);
			$this->param['RESULT'] = 1;
			$this->param['mole'] = $mole;
			$this->param['st'] = $st;
			$this->param['ans'] = $ans;
            return $this->param;
		}else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
		}
	}

	   // Empirical Formula Calculator
	   public function empirical($request){
		$e1=$request->e1;
		$e2=$request->e2;
		$e3=$request->e3;
		$e4=$request->e4;
		$e5=$request->e5;
		$e6=$request->e6;
		$m1=$request->m1;
		$m2=$request->m2;
		$m3=$request->m3;
		$m4=$request->m4;
		$m5=$request->m5;
		$m6=$request->m6;
		$periodic_values=array(
			'H'=>1.008,'He'=>4.0026,'Li'=>6.94,
			'Be'=>9.0122,'B'=>10.81,'C'=>12.011,'N'=>14.007,'O'=>15.999,'F'=>18.998,'Ne'=>20.180,'Na'=>22.990,'Mg'=>24.305,'Al'=>26.982,'Si'=>28.085,'P'=>30.974,'S'=>32.06,'Cl'=>35.45,'Ar'=>39.948,'K'=>39.098,'Ca'=>40.078,'Sc'=>44.956,'Ti'=>47.867,'V'=>50.942,'Cr'=>51.996,'Mn'=>54.938,'Fe'=>55.845,'Co'=>58.933,'Ni'=>58.693,'Cu'=>63.546,'Zn'=>65.38,'Ga'=>69.723,'Ge'=>72.630,'As'=>74.922,'Se'=>78.971,'Br'=>79.904,'Kr'=>83.798,'Rb'=>85.468,'Sr'=>87.62,'Y'=>88.906,'Zr'=>91.224,'Nb'=>92.906,'Mo'=>95.95,'Tc'=>98,'Ru'=>101.07,'Rh'=>102.91,'Pd'=>106.42,'Ag'=>107.87,'Cd'=>112.41,'In'=>114.82,'Sn'=>118.71,'Sb'=>121.76,'Te'=>127.60,'I'=>126.90,'Xe'=>131.29,'Cs'=>132.91,'Ba'=>137.33,'La'=>138.91,'Ce'=>140.12,'Pr'=>140.91,'Nd'=>144.24,'Pm'=>145,'Sm'=>150.36,'Eu'=>151.96,'Gd'=>157.25,'Tb'=>158.93,'Dy'=>162.50,'Ho'=>164.93,'Er'=>167.26,'Tm'=>168.93,'Yb'=>173.05,'Lu'=>174.97,'Hf'=>178.49,'Ta'=>180.95,'W'=>183.84,'Re'=>186.21,'Os'=>190.23,'Ir'=>192.22,'Pt'=>195.08,'Au'=>196.97,'Hg'=>200.59,'Tl'=>204.38,'Pb'=>207.2,'Bi'=>208.98,'Po'=>209,'At'=>210,'Rn'=>222,'Fr'=>223,'Ra'=>226,'Ac'=>227,'Th'=>232.04,'Pa'=>231.04,'U'=>238.03,'Np'=>237,'Pu'=>244,'Am'=>243,'Cm'=>247,'Bk'=>247,'Cf'=>251,'Es'=>252,'Fm'=>257,'Md'=>258,'No'=>259,'Lr'=>266,'Rf'=>267,'Db'=>268,'Sg'=>269,'Bh'=>270,'Hs'=>277,'Mt'=>278,'Ds'=>281,'Rg'=>282,'Cn'=>285,'Nh'=>286,'Fl'=>289,'Mc'=>290,'Lv'=>293,'Ts'=>294,'Og'=>294
		);
		$check=true;
		$values = array();
		for($i=1; $i < 7; $i++){ 
			if(!empty($request->{"e$i"}) && is_numeric($request->{"m$i"})){
				$e=trim($request->{"e$i"});
				$e=stripslashes($e);
				$e=htmlspecialchars($e);
				$values[]=$request->{"e$i"}."-".$request->{"m$i"};
			}
			if(!empty($request->{"e$i"}) && !is_numeric($request->{"m$i"})){
				$check=false;
			}elseif (empty($request->{"e$i"}) && !empty($request->{"m$i"})){
				$check=false;
			}
		}
		$moles=array();
		$s1='';
		$s2='';
		$s3='';
		$s4='';
		$s5='';
		$s6='';
		$s7='';
		if($check===true && !empty($values)){
			foreach($values as $key => $value){
				$index=explode('-', $value);
				$in=strtolower($index[0]);
				$in=ucfirst($in);
				$s1.="<td class='border-b p-2 font-s-18'> $in </td>";
				$this->param['s1'] = $s1;
				if(array_key_exists($in, $periodic_values)){
					$moles[]=$index[1]/$periodic_values[$in];
					$s2.="<td class='border-b p-2 font-s-18'> $index[1]g </td>";
					$this->param['s2'] = $s2;
					$s3.="<td class='border-b p-2 font-s-22'>".'\( \frac {'."$index[1]".'}{'."$periodic_values[$in]".'} \)'."</td>";
					$this->param['s3'] = $s3;
				}else{
                    $this->param['error'] = 'Please! Check Your Input';
                    return $this->param;
				}
			}
			$min_val=min($moles);
			$res=array();
			foreach($moles as $key => $value){
				$s4.="<td class='border-b p-2 font-s-18'> ".round($moles[$key])." </td>";
				$this->param['s4'] = $s4;
				$res_=round($value/$min_val);
				$s5.="<td class='border-b p-2 font-s-22'>".'\( \frac {'.round($value).'}{'.round($min_val).'} \)'."</td>";
				$this->param['s5'] = $s5;
				$s6.="<td class='border-b p-2 font-s-18'>$res_</td>";
				$this->param['s6'] = $s6;
				if($res_==1){
					$res_='';
				}
				$res[]=$res_;
			}
			$formula='';
			foreach($values as $key => $value){
				$index=explode('-', $value);
				$in=strtolower($index[0]);
				$in=ucfirst($in);
				$formula.="$in<sub class='text-green'>".$res[$key]."</sub>";
			}
			$count=count($values);
			$this->param['formula'] = $formula;
			$this->param['count'] = $count;
            return $this->param;
		}else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
		}
	}

    // Empirical Formula Calculator
	// public function empirical($request){
	// 	$e1=request()->input('e1');
	// 	$e2=request()->input('e2');
	// 	$e3=request()->input('e3');
	// 	$e4=request()->input('e4');
	// 	$e5=request()->input('e5');
	// 	$e6=request()->input('e6');
	// 	$m1=request()->input('m1');
	// 	$m2=request()->input('m2');
	// 	$m3=request()->input('m3');
	// 	$m4=request()->input('m4');
	// 	$m5=request()->input('m5');
	// 	$m6=request()->input('m6');
	// 	$e7=request()->input('e7');
	// 	$e8=request()->input('e8');
	// 	$e9=request()->input('e9');
	// 	$e10=request()->input('e10');
	// 	$m1=request()->input('m1');
	// 	$m2=request()->input('m2');
	// 	$m3=request()->input('m3');
	// 	$m4=request()->input('m4');
	// 	$m5=request()->input('m5');
	// 	$m6=request()->input('m6');
	// 	$m7=request()->input('m7');
	// 	$m8=request()->input('m8');
	// 	$m9=request()->input('m9');
	// 	$m10=request()->input('m10');
	// 	$eqution=request()->input('eqution');
	// 	$periodic_values=array(
	// 		'H'=>1.008,'He'=>4.0026,'Li'=>6.94,
	// 		'Be'=>9.0122,'B'=>10.81,'C'=>12.011,'N'=>14.007,'O'=>15.999,'F'=>18.998,'Ne'=>20.180,'Na'=>22.990,'Mg'=>24.305,'Al'=>26.982,'Si'=>28.085,'P'=>30.974,'S'=>32.06,'Cl'=>35.45,'Ar'=>39.948,'K'=>39.098,'Ca'=>40.078,'Sc'=>44.956,'Ti'=>47.867,'V'=>50.942,'Cr'=>51.996,'Mn'=>54.938,'Fe'=>55.845,'Co'=>58.933,'Ni'=>58.693,'Cu'=>63.546,'Zn'=>65.38,'Ga'=>69.723,'Ge'=>72.630,'As'=>74.922,'Se'=>78.971,'Br'=>79.904,'Kr'=>83.798,'Rb'=>85.468,'Sr'=>87.62,'Y'=>88.906,'Zr'=>91.224,'Nb'=>92.906,'Mo'=>95.95,'Tc'=>98,'Ru'=>101.07,'Rh'=>102.91,'Pd'=>106.42,'Ag'=>107.87,'Cd'=>112.41,'In'=>114.82,'Sn'=>118.71,'Sb'=>121.76,'Te'=>127.60,'I'=>126.90,'Xe'=>131.29,'Cs'=>132.91,'Ba'=>137.33,'La'=>138.91,'Ce'=>140.12,'Pr'=>140.91,'Nd'=>144.24,'Pm'=>145,'Sm'=>150.36,'Eu'=>151.96,'Gd'=>157.25,'Tb'=>158.93,'Dy'=>162.50,'Ho'=>164.93,'Er'=>167.26,'Tm'=>168.93,'Yb'=>173.05,'Lu'=>174.97,'Hf'=>178.49,'Ta'=>180.95,'W'=>183.84,'Re'=>186.21,'Os'=>190.23,'Ir'=>192.22,'Pt'=>195.08,'Au'=>196.97,'Hg'=>200.59,'Tl'=>204.38,'Pb'=>207.2,'Bi'=>208.98,'Po'=>209,'At'=>210,'Rn'=>222,'Fr'=>223,'Ra'=>226,'Ac'=>227,'Th'=>232.04,'Pa'=>231.04,'U'=>238.03,'Np'=>237,'Pu'=>244,'Am'=>243,'Cm'=>247,'Bk'=>247,'Cf'=>251,'Es'=>252,'Fm'=>257,'Md'=>258,'No'=>259,'Lr'=>266,'Rf'=>267,'Db'=>268,'Sg'=>269,'Bh'=>270,'Hs'=>277,'Mt'=>278,'Ds'=>281,'Rg'=>282,'Cn'=>285,'Nh'=>286,'Fl'=>289,'Mc'=>290,'Lv'=>293,'Ts'=>294,'Og'=>294
	// 	);
	// 	$check=true;
	// 	$values = array();
	// 	for($i=1; $i < 11; $i++){ 
	// 		if(!empty($request->{"e$i"}) && is_numeric($request->{"m$i"})){
	// 			$e=trim($request->{"e$i"});
	// 			$e=stripslashes($e);
	// 			$e=htmlspecialchars($e);
	// 			$values[]=$request->{"e$i"}."-".$request->{"m$i"};
	// 		}
	// 		if(!empty($request->{"e$i"}) && !is_numeric($request->{"m$i"})){
	// 			$check=false;
	// 		}elseif (empty($request->{"e$i"}) && !empty($request->{"m$i"})){
	// 			$check=false;
	// 		}
	// 	}
	// 	$values = str_replace('-','=' ,$values);
	// 	$values_string = implode(", ", $values);
	// 	if (!empty($values_string)) {
	// 		$format = '{
	// 			"steps": [
	// 				"<p class="mt-3">steps here</p>",
	// 				// continue for more steps
	// 			]
	// 		}';
	// 		$prompt = "Check the input = $values_string , If the sum of the mass percentages does not equal to 100%, then you must only show the relevant error message rather than giving any error explanation or error handling details. But if the sum of the mass percentages =100%, use the empirical formula calculator to compute the empirical formula of the compound for the given inputs = $values_string
	// 		, provide the answer in short steps. Each step, even all the text lines must be formatted in LaTeX using KaTeX.
	// 		Note:
	// 		Each step and all text lines must be formatted in KaTeX, Don't tell me that you are using Katex in each line and that you are using error handling..!";
	// 		$client = new Client();
	// 		$response = $client->post('https://api.openai.com/v1/chat/completions', [
	// 			'headers' => [
	// 				// 'Authorization' => 'Bearer ' . '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',
	// 				'Authorization' => 'Bearer ' .  env('OPENAI_API_KEY'),
	// 				'Content-Type' => 'application/json'
	// 			],
	// 			'json' => [
	// 				"model" => "gpt-4o-mini",
	// 				// "model" => "gpt-3.5-turbo",
	// 				"response_format" => [
	// 					"type" => "text"
	// 				],
	// 				"max_tokens" => 3000,
	// 				"messages" => [
	// 					[
	// 						"role" => "user",
	// 						"content" => $prompt
	// 					]
	// 				]
	// 			]
	// 		]);
	// 		$data = json_decode($response->getBody()->getContents(), true);
	// 		$dataArray = $data['choices'][0]['message']['content'];
	// 		$this->param['dataArray'] = $dataArray;
	// 		return $this->param;
	// 	}else{
	// 		$this->param['error'] = 'Please! Add at least 2 Element and its Percentage of Mass.';
	// 		return $this->param;
	// 	}
	// }

	// Charles' Law Calculator
    public function charles($request){
        $find=$request->find;
        $v1=$request->v1;
        $v1_unit=$request->v1_unit;
        $t1=$request->t1;
        $t1_unit=$request->t1_unit;
        $v2=$request->v2;
        $v2_unit=$request->v2_unit;
        $t2=$request->t2;
        $t2_unit=$request->t2_unit;
        $p=$request->p;
        $n=$request->n;
        $R=$request->R;

		if(is_numeric($v1) && is_numeric($t1) && is_numeric($v2) && is_numeric($t2) && is_numeric($p) && is_numeric($n) && is_numeric($R)){
			// Unit Conversion
			if(is_numeric($v1)){
				if($v1_unit==='mm³'){
					$v1=$v1/1000000000;
				}elseif($v1_unit==='cm³' || $v1_unit==='ml'){
					$v1=$v1/1000000;
				}elseif($v1_unit==='dm³' || $v1_unit==='liters'){
					$v1=$v1/1000;
				}elseif($v1_unit==='cu in'){
					$v1=$v1/61024;
				}elseif($v1_unit==='cu ft'){
					$v1=$v1/35.315;
				}elseif($v1_unit==='cu yd'){
					$v1=$v1/1.308;
				}
			}
			if(is_numeric($t1)){
				if($t1_unit==='c'){
					$t1=$t1+273.15;
				}elseif($t1_unit==='f'){
					$t1=($t1-32)*(5/9)+273.15;
				}
			}
			if(is_numeric($v2)){
				if($v2_unit==='mm³'){
					$v2=$v2/1000000000;
				}elseif($v2_unit==='cm³' || $v2_unit==='ml'){
					$v2=$v2/1000000;
				}elseif($v2_unit==='dm³' || $v2_unit==='liters'){
					$v2=$v2/1000;
				}elseif($v2_unit==='cu in'){
					$v2=$v2/61024;
				}elseif($v2_unit==='cu ft'){
					$v2=$v2/35.315;
				}elseif($v2_unit==='cu yd'){
					$v2=$v2/1.308;
				}
			}
			if(is_numeric($t2)){
				if($t2_unit==='°C'){
					$t2=$t2+273.15;
				}elseif($t2_unit==='°F'){
					$t2=($t2-32)*(5/9)+273.15;
				}
			}
			if(is_numeric($p)){
				if($v2_unit==='bar'){
					$v2=$v2/0.00001;
				}elseif($v2_unit==='psi'){
					$v2=$v2/0.00014504;
				}elseif($v2_unit==='at'){
					$v2=$v2/0.000010197;
				}elseif($v2_unit==='atm'){
					$v2=$v2/0.00000987;
				}elseif($v2_unit==='Torr'){
					$v2=$v2/0.0075;
				}elseif($v2_unit==='hPa'){
					$v2=$v2/0.01;
				}elseif($v2_unit==='kPa'){
					$v2=$v2/0.001;
				}elseif($v2_unit==='MPa'){
					$v2=$v2/0.000001;
				}elseif($v2_unit==='GPa'){
					$v2=$v2/0.000000001;
				}elseif($v2_unit==='in Hg'){
					$v2=$v2/0.0002953;
				}elseif($v2_unit==='mmHg'){
					$v2=$v2/0.0075;
				}
			}
			if($find==='v1' && is_numeric($t1) && is_numeric($v2) && is_numeric($t2)){
				$v1=($v2/$t2)*$t1;
				$mm3=$v1*1000000000;
				$cm3=$v1*1000000;
				$dm3=$v1*1000;
				$cu_in=$v1*61024;
				$cu_ft=$v1*35.315;
				$cu_yd=$v1*1.308;
				$p=101325;
				$n=($p*$v1)/($R*$t1);
				$this->param['v1']=round($v1,5);
				$this->param['p']=$p;
				$this->param['n']=round($n,5);
				$this->param['mm3']=$mm3;
				$this->param['cm3']=$cm3;
				$this->param['dm3']=$dm3;
				$this->param['cu_in']=$cu_in;
				$this->param['cu_ft']=$cu_ft;
				$this->param['cu_yd']=$cu_yd;
			}elseif($find==='t1' && is_numeric($v1) && is_numeric($v2) && is_numeric($t2)){
				$t1=($t2/$v2)*$v1;
				$c=$t1-273.15;
				$f=($t1-273.15)*(9/5)+32;
				$p=101325;
				$n=($p*$v1)/($R*$t1);
				$this->param['t1']=round($t1,5);
				$this->param['p']=$p;
				$this->param['n']=round($n,5);
				$this->param['c']=$c;
				$this->param['f']=$f;
			}elseif($find==='v2' && is_numeric($v1) && is_numeric($t1) && is_numeric($t2)){
				$v2=($v1/$t1)*$t2;
				$mm3=$v2*1000000000;
				$cm3=$v2*1000000;
				$dm3=$v2*1000;
				$cu_in=$v2*61024;
				$cu_ft=$v2*35.315;
				$cu_yd=$v2*1.308;
				$p=101325;
				$n=($p*$v1)/($R*$t1);
				$this->param['v2']=round($v2,5);
				$this->param['p']=$p;
				$this->param['n']=round($n,5);
				$this->param['mm3']=$mm3;
				$this->param['cm3']=$cm3;
				$this->param['dm3']=$dm3;
				$this->param['cu_in']=$cu_in;
				$this->param['cu_ft']=$cu_ft;
				$this->param['cu_yd']=$cu_yd;
			}elseif($find==='t2' && is_numeric($v1) && is_numeric($t1) && is_numeric($v2)){
				$t2=($t1/$v1)*$v2;
				$c=$t2-273.15;
				$f=($t2-273.15)*(9/5)+32;
				$p=101325;
				$n=($p*$v1)/($R*$t1);
				$this->param['t2']=round($t2,5);
				$this->param['p']=$p;
				$this->param['n']=round($n,5);
				$this->param['c']=$c;
				$this->param['f']=$f;
			}elseif($find==='p' && is_numeric($v1) && is_numeric($t1) && is_numeric($v2) && is_numeric($t2)  && is_numeric($n)  && is_numeric($R)){
				$p=($n*$R*$t1)/$v1;
				$bar=$p*0.00001;
				$psi=$p*0.00014504;
				$at=$p*0.000010197;
				$atm=$p*0.00000987;
				$torr=$p*0.0075;
				$hpa=$p*0.01;
				$kpa=$p*0.001;
				$mpa=$p*0.000001;
				$gpa=$p*0.000000001;
				$in_hg=$p*0.0002953;
				$mmhg=$p*0.0075;
				$this->param['p_val']=round($p,5);
				$this->param['bar']=$bar;
				$this->param['psi']=$psi;
				$this->param['at']=$at;
				$this->param['atm']=$atm;
				$this->param['torr']=$torr;
				$this->param['hpa']=$hpa;
				$this->param['kpa']=$kpa;
				$this->param['mpa']=$mpa;
				$this->param['gpa']=$gpa;
				$this->param['in_hg']=$in_hg;
				$this->param['mmhg']=$mmhg;
			}elseif($find==='n' && is_numeric($v1) && is_numeric($t1) && is_numeric($v2) && is_numeric($t2)  && is_numeric($p)  && is_numeric($R)){
				$n=($p*$v1)/($R*$t1);
				$this->param['n_val']=round($n,5);
			}else{
                $this->param['error'] = 'Please! Fill All The Fields.';
                return $this->param;
			}
			$this->param['RESULT'] = 1;
            return $this->param;
		}else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
		}
	}

 // Electron Configuration Calculator
 function electron($request){
	$element=$request->element;
	if(!empty($element)){
		$periodic_table = [
			'H' => [ 0 => 1, 1 => 'Hydrogen', 2 => 'Gas', 3 => 1.008, 4 => '1s¹', 5 => 'N/A', 6=>'1s¹' ],
			'He' => [ 0 => 2, 1 => 'Helium', 2 => 'Gas', 3 => 4.0026, 4 => '1s²', 5 => 'N/A' , 6 => '1s²' ],
			'Li' => [ 0 => 3, 1 => 'Lithium', 2 => 'Solid', 3 => 6.94, 4 => '1s²2s¹', 5 => '[He]2s¹', 6 => '2s¹' ],
			'Be' => [ 0 => 4, 1 => 'Beryllium', 2 => 'Solid', 3 => 9.0122, 4 => '1s²2s²', 5 => '[He]2s²', 6 => '2s²' ],
			'B' => [ 0 => 5, 1 => 'Boron', 2 => 'Solid', 3 => 10.81, 4 => '1s²2s²2p¹', 5 => '[He]2s²2p¹', 6 => '2s²2p¹' ],
			'C' => [ 0 => 6, 1 => 'Carbon', 2 => 'Solid', 3 => 12.011, 4 => '1s²2s²2p²', 5 => '[He]2s²2p²', 6 => '2s²2s²' ],
			'N' => [ 0 => 7, 1 => 'Nitrogen', 2 => 'Gas', 3 => 14.007, 4 => '1s²2s²2p³', 5 => '[He]2s²2p³', 6 => '2s²2p³' ],
			'O' => [ 0 => 8, 1 => 'Oxygen', 2 => 'Gas', 3 => 15.999, 4 => '1s²2s²2p⁴', 5 => '[He]2s²2p⁴', 6 => '2s²2p⁴' ],
			'F' => [ 0 => 9, 1 => 'Fluorine', 2 => 'Gas', 3 => 18.998, 4 => '1s²2s²2p⁵', 5 => '[He]2s²2p⁵', 6 => '2s²2p⁵' ],
			'Ne' => [ 0 => 10, 1 => 'Neon', 2 => 'Gas', 3 => 20.180, 4 => '1s²2s²2p⁶', 5 => '[He]2s²2p⁶', 6 => '2s²2p⁶'  ],
			'Na' => [ 0 => 11, 1 => 'Sodium', 2 => 'Solid', 3 => 22.990, 4 => '1s²2s²2p⁶3s¹', 5 => '[Ne]3s¹' , 6 => '3s¹' ],
			'Mg' => [ 0 => 12, 1 => 'Magnesium', 2 => 'Solid', 3 => 24.305, 4 => '1s²2s²2p⁶3s²', 5 => '[Ne]3s²' , 6 => '3s²'],
			'Al' => [ 0 => 13, 1 => 'Aluminum', 2 => 'Solid', 3 => 26.982, 4 => '1s²2s²2p⁶3s²3p¹', 5 => '[Ne]3s²3p¹', 6 => '3s²3p¹'],
			'Si' => [ 0 => 14, 1 => 'Silicon', 2 => 'Solid', 3 => 28.085, 4 => '1s²2s²2p⁶3s²3p²', 5 => '[Ne]3s²3p²' , 6 => '3s²3p²'],
			'P' => [ 0 => 15, 1 => 'Phosphorus', 2 => 'Solid', 3 => 30.974, 4 => '1s²2s²2p⁶3s²3p³', 5 => '[Ne]3s²3p³', 6 => '3s²3p³' ],
			'S' => [ 0 => 16, 1 => 'Sulfur', 2 => 'Solid', 3 => 32.06, 4 => '1s²2s²2p⁶3s²3p⁴', 5 => '[Ne]3s²3p⁴' , 6 => '3s²3p⁴' ],
			'Cl' => [ 0 => 17, 1 => 'Chlorine', 2 => 'Gas', 3 => 35.45, 4 => '1s²2s²2p⁶3s²3p⁵', 5 => '[Ne]3s²3p⁵', 6 => '3s²3p⁵' ],
			'Ar' => [ 0 => 18, 1 => 'Argon', 2 => 'Gas', 3 => 39.948, 4 => '1s²2s²2p⁶3s²3p⁶', 5 => '[Ne]3s²3p⁶', 6 => '3s²3p⁶' ],
			'K' => [ 0 => 19, 1 => 'Potassium', 2 => 'Solid', 3 => 39.098, 4 => '1s²2s²2p⁶3s²3p⁶4s¹', 5 => '[Ar]4s¹', 6 => '4s¹' ],
			'Ca' => [ 0 => 20, 1 => 'Calcium', 2 => 'Solid', 3 => 40.078, 4 => '1s²2s²2p⁶3s²3p⁶4s²', 5 => '[Ar]4s²', 6 => '4s²' ],
			'Sc' => [ 0 => 21, 1 => 'Scandium', 2 => 'Solid', 3 => 44.956, 4 => '1s²2s²2p⁶3s²3p⁶3d¹4s²', 5 => '[Ar]4s²3d¹', 6 => '3d¹4s²' ],
			'Ti' => [ 0 => 22, 1 => 'Titanium', 2 => 'Solid', 3 => 47.867, 4 => '1s²2s²2p⁶3s²3p⁶3d²4s²', 5 => '[Ar]4s²3d²', 6 => '3d²4s²' ],
			'V' => [ 0 => 23, 1 => 'Vanadium', 2 => 'Solid', 3 => 50.942, 4 => '1s²2s²2p⁶3s²3p⁶3d³4s²', 5 => '[Ar]4s²3d³', 6 => '3d³4s²' ],
			'Cr' => [ 0 => 24, 1 => 'Chromium', 2 => 'Solid', 3 => 51.996, 4 => '1s²2s²2p⁶3s²3p⁶3d⁵4s¹', 5 => '[Ar]3d⁵4s¹', 6 => '3d⁵4s¹' ],
			'Mn' => [ 0 => 25, 1 => 'Manganese', 2 => 'Solid', 3 => 54.938, 4 => '1s²2s²2p⁶3s²3p⁶3d⁵4s²', 5 => '[Ar]4s²3d⁵', 6 => '3d⁵4s²' ],
			'Fe' => [ 0 => 26, 1 => 'Iron', 2 => 'Solid', 3 => 55.845, 4 => '1s²2s²2p⁶3s²3p⁶3d64s²', 5 => '[Ar]4s²3d⁶', 6 => '3d64s²' ],
			'Co' => [ 0 => 27, 1 => 'Cobalt', 2 => 'Solid', 3 => 58.933, 4 => '1s²2s²2p⁶3s²3p⁶3d⁷4s²', 5 => '[Ar]4s²3d⁷', 6 => '3d⁷4s²' ],
			'Ni' => [ 0 => 28, 1 => 'Nickel', 2 => 'Solid', 3 => 58.693, 4 => '1s²2s²2p⁶3s²3p⁶3d⁸4s²', 5 => '[Ar]4s²3d⁸', 6 => '3d⁸4s²' ],
			'Cu' => [ 0 => 29, 1 => 'Copper', 2 => 'Solid', 3 => 63.546, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s¹', 5 => '[Ar]4s¹3d¹⁰', 6 => '3d¹⁰4s¹' ],
			'Zn' => [ 0 => 30, 1 => 'Zinc', 2 => 'Solid', 3 => 65.38, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²', 5 => '[Ar]4s²3d¹⁰', 6 => '3d¹⁰4s²' ],
			'Ga' => [ 0 => 31, 1 => 'Gallium', 2 => 'Solid', 3 => 69.723, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p¹', 5 => '[Ar]4s²3d¹⁰4p¹', 6 => '4s²4p¹' ],
			'Ge' => [ 0 => 32, 1 => 'Germanium', 2 => 'Solid', 3 => 72.630, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p²', 5 => '[Ar]4s²3d¹⁰4p²', 6 => '4s²4p²' ],
			'As' => [ 0 => 33, 1 => 'Arsenic', 2 => 'Solid', 3 => 74.922, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p³', 5 => '[Ar]4s²3d¹⁰4p³', 6 => '4s²4p³' ],
			'Se' => [ 0 => 34, 1 => 'Selenium', 2 => 'Solid', 3 => 78.971, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁴', 5 => '[Ar]4s²3d¹⁰4p⁴', 6 => '4s²4p⁴' ],
			'Br' => [ 0 => 35, 1 => 'Bromine', 2 => 'Liquid', 3 => 79.904, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁵', 5 => '[Ar]4s²3d¹⁰4p⁵', 6 => '4s²4p⁵' ],
			'Kr' => [ 0 => 36, 1 => 'Krypton', 2 => 'Gas', 3 => 83.798, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶', 5 => '[Ar]4s²3d¹⁰4p⁶', 6 => '4s²4p⁶' ],
			'Rb' => [ 0 => 37, 1 => 'Rubidium', 2 => 'Solid', 3 => 85.468, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶5s¹', 5 => '[Kr]5s¹', 6 => '5s¹' ],
			'Sr' => [ 0 => 38, 1 => 'Strontium', 2 => 'Solid', 3 => 87.62, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶5s²', 5 => '[Kr]5s²', 6 => '5s²' ],
			'Y' => [ 0 => 39, 1 => 'Yttrium', 2 => 'Solid', 3 => 88.906, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹5s²', 5 => '[Kr]5s²4d¹', 6 => '4d¹5s²' ],
			'Zr' => [ 0 => 40, 1 => 'Zirconium', 2 => 'Solid', 3 => 91.224, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d²5s²', 5 => '[Kr]5s²4d²', 6 => '4d²5s²' ],
			'Nb' => [ 0 => 41, 1 => 'Niobium', 2 => 'Solid', 3 => 92.906, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d⁴5s¹', 5 => '[Kr]5s¹4d⁴', 6 => '4d⁴5s¹' ],
			'Mo' => [ 0 => 42, 1 => 'Molybdenum', 2 => 'Solid', 3 => 95.95, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d⁵5s¹', 5 => '[Kr]5s¹4d⁵', 6 => '4d⁵5s¹' ],
			'Tc' => [ 0 => 43, 1 => 'Technetium', 2 => 'Solid', 3 => 98, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d⁵5s²', 5 => '[Kr]5s²4d⁵', 6 => '4d⁵5s²' ],
			'Ru' => [ 0 => 44, 1 => 'Ruthenium', 2 => 'Solid', 3 => 101.07, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d⁷5s¹', 5 => '[Kr]5s¹4d⁷', 6 => '4d⁷5s¹' ],
			'Rh' => [ 0 => 45, 1 => 'Rhodium', 2 => 'Solid', 3 => 102.91, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d⁸5s¹', 5 => '[Kr]5s¹4d⁸', 6 => '4d⁸5s¹' ],
			'Pd' => [ 0 => 46, 1 => 'Palladium', 2 => 'Solid', 3 => 106.42, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰', 5 => '[Kr]4d¹⁰', 6 => '4d¹⁰' ],
			'Ag' => [ 0 => 47, 1 => 'Silver', 2 => 'Solid', 3 => 107.87, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s¹', 5 => '[Kr]5s¹4d¹⁰', 6 => '4d¹⁰5s¹' ],
			'Cd' => [ 0 => 48, 1 => 'Cadmium', 2 => 'Solid', 3 => 112.41, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²', 5 => '[Kr]5s²4d¹⁰', 6 => '4d¹⁰5s²' ],
			'In' => [ 0 => 49, 1 => 'Indium', 2 => 'Solid', 3 => 114.82, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p¹', 5 => '[Kr]5s²4d¹⁰5p¹', 6 => '5s²5p¹' ],
			'Sn' => [ 0 => 50, 1 => 'Tin', 2 => 'Solid', 3 => 118.71, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p²', 5 => '[Kr]5s²4d¹⁰5p²', 6 => '5s²5p²' ],
			'Sb' => [ 0 => 51, 1 => 'Antimony', 2 => 'Solid', 3 => 121.76, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p³', 5 => '[Kr]5s²4d¹⁰5p³', 6 => '5s²5p³' ],
			'Te' => [ 0 => 52, 1 => 'Tellurium', 2 => 'Solid', 3 => 127.60, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁴', 5 => '[Kr]5s²4d¹⁰5p⁴', 6 => '5s²5p⁴' ],
			'I' => [ 0 => 53, 1 => 'Iodine', 2 => 'Solid', 3 => 126.90, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁵', 5 => '[Kr]5s²4d¹⁰5p⁵', 6 => '5s²5p⁵' ],
			'Xe' => [ 0 => 54, 1 => 'Xenon', 2 => 'Gas', 3 => 131.29, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶', 5 => '[Kr]5s²4d¹⁰5p⁶', 6 => '5s²5p⁶' ],
			'Cs' => [ 0 => 55, 1 => 'Cesium', 2 => 'Solid', 3 => 132.91, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s¹', 5 => '[Xe]6s¹', 6 => '6s¹' ],
			'Ba' => [ 0 => 56, 1 => 'Barium', 2 => 'Solid', 3 => 137.33, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²', 5 => '[Xe]6s²', 6 => '6s²' ],
			'La' => [ 0 => 57, 1 => 'Lanthanum', 2 => 'Solid', 3 => 138.91, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²5d¹', 5 => '[Xe]6s²5d¹', 6 => '6s²5d¹' ],
			'Ce' => [ 0 => 58, 1 => 'Cerium', 2 => 'Solid', 3 => 140.12, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹5d¹', 5 => '[Xe]6s²4f¹5d¹', 6 => '6s²4f¹5d¹' ],
			'Pr' => [ 0 => 59, 1 => 'Praseodymium', 2 => 'Solid', 3 => 140.91, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f³', 5 => '[Xe]6s²4f³', 6 => '6s²4f³' ],
			'Nd' => [ 0 => 60, 1 => 'Neodymium', 2 => 'Solid', 3 => 144.24, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f⁴', 5 => '[Xe]6s²4f⁴', 6 => '6s²4f⁴' ],
			'Pm' => [ 0 => 61, 1 => 'Promethium', 2 => 'Solid', 3 => 145, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f⁵', 5 => '[Xe]6s²4f⁵', 6 => '6s²4f⁵' ],
			'Sm' => [ 0 => 62, 1 => 'Samarium', 2 => 'Solid', 3 => 150.36, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f⁶', 5 => '[Xe]6s²4f⁶', 6 => '6s²4f⁶' ],
			'Eu' => [ 0 => 63, 1 => 'Europium', 2 => 'Solid', 3 => 151.96, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f⁷', 5 => '[Xe]6s²4f⁷', 6 => '6s²4f⁷' ],
			'Gd' => [ 0 => 64, 1 => 'Gadolinium', 2 => 'Solid', 3 => 157.25, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶5d¹6s²4f⁷', 5 => '[Xe]6s²4f⁷5d¹', 6 => '6s²4f⁷5d¹' ],
			'Tb' => [ 0 => 65, 1 => 'Terbium', 2 => 'Solid', 3 => 158.93, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f⁹', 5 => '[Xe]6s²4f⁹', 6 => '6s²4f⁹' ],
			'Dy' => [ 0 => 66, 1 => 'Dysprosium', 2 => 'Solid', 3 => 162.50, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁰', 5 => '[Xe]6s²4f¹⁰', 6 => '6s²4f¹⁰' ],
			'Ho' => [ 0 => 67, 1 => 'Holmium', 2 => 'Solid', 3 => 164.93, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹¹', 5 => '[Xe]6s²4f¹¹', 6 => '6s²4f¹¹' ],
			'Er' => [ 0 => 68, 1 => 'Erbium', 2 => 'Solid', 3 => 167.26, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹²', 5 => '[Xe]6s²4f¹²', 6 => '6s²4f¹²' ],
			'Tm' => [ 0 => 69, 1 => 'Thulium', 2 => 'Solid', 3 => 168.93, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹³', 5 => '[Xe]6s²4f¹³', 6 => '6s²4f¹³' ],
			'Yb' => [ 0 => 70, 1 => 'Ytterbium', 2 => 'Solid', 3 => 173.05, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴', 5 => '[Xe]6s²4f¹⁴', 6 => '6s²4f¹⁴' ],
			'Lu' => [ 0 => 71, 1 => 'Lutetium', 2 => 'Solid', 3 => 174.97, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹', 5 => '[Xe]6s²4f¹⁴5d¹', 6 => '6s²⁴5d¹' ],
			'Hf' => [ 0 => 72, 1 => 'Hafnium', 2 => 'Solid', 3 => 178.49, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d²', 5 => '[Xe]6s²4f¹⁴5d²', 6 => '6s²5d²' ],
			'Ta' => [ 0 => 73, 1 => 'Tantalum', 2 => 'Solid', 3 => 180.95, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d³', 5 => '[Xe]6s²4f¹⁴5d³', 6 => '6s²5d³' ],
			'W' => [ 0 => 74, 1 => 'Tungsten', 2 => 'Solid', 3 => 183.84, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d4', 5 => '[Xe]6s²4f¹⁴5d⁴', 6 => '6s²5d⁴' ],
			'Re' => [ 0 => 75, 1 => 'Rhenium', 2 => 'Solid', 3 => 186.21, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d⁵', 5 => '[Xe]6s²4f¹⁴5d⁵', 6 => '6s²5d⁵' ],
			'Os' => [ 0 => 76, 1 => 'Osmium', 2 => 'Solid', 3 => 190.23, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d6', 5 => '[Xe]6s²4f¹⁴5d⁶', 6 => '6s²5d⁶' ],
			'Ir' => [ 0 => 77, 1 => 'Iridium', 2 => 'Solid', 3 => 192.22, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d⁷', 5 => '[Xe]6s²4f¹⁴5d⁷', 6 => '6s²5d⁷' ],
			'Pt' => [ 0 => 78, 1 => 'Platinum', 2 => 'Solid', 3 => 195.08, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s¹4f¹⁴5d⁹', 5 => '[Xe]6s¹4f¹⁴5d⁹', 6 => '6s¹5d⁹' ],
			'Au' => [ 0 => 79, 1 => 'Gold', 2 => 'Solid', 3 => 196.97, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s¹4f¹⁴5d¹⁰', 5 => '[Xe]6s¹4f¹⁴5d¹⁰', 6 => '6s¹5d¹⁰' ],
			'Hg' => [ 0 => 80, 1 => 'Mercury', 2 => 'Solid', 3 => 200.59, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰', 5 => '[Xe]6s²4f¹⁴5d¹⁰', 6 => '6s²5d¹⁰' ],
			'Tl' => [ 0 => 81, 1 => 'Thallium', 2 => 'Solid', 3 => 204.38, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p¹', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p¹', 6 => '6s²6p¹' ],
			'Pb' => [ 0 => 82, 1 => 'Lead', 2 => 'Solid', 3 => 207.2, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p²', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p²', 6 => '6s²6p²' ],
			'Bi' => [ 0 => 83, 1 => 'Bismuth', 2 => 'Solid', 3 => 208.98, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p³', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p³', 6 => '6s²6p³' ],
			'Po' => [ 0 => 84, 1 => 'Polonium', 2 => 'Solid', 3 => 209, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁴', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p⁴', 6 => '6s²6p⁴' ],
			'At' => [ 0 => 85, 1 => 'Astatine', 2 => 'Solid', 3 => 210, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁵', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p⁵', 6 => '6s²6p⁵' ],
			'Rn' => [ 0 => 86, 1 => 'Radon', 2 => 'Gas', 3 => 222, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p⁶', 6 => '6s²6p⁶' ],
			'Fr' => [ 0 => 87, 1 => 'Francium', 2 => 'Solid', 3 => 223, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s¹', 5 => '[Rn]7s¹', 6 => '7s¹' ],
			'Ra' => [ 0 => 88, 1 => 'Radium', 2 => 'Solid', 3 => 226, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²', 5 => '[Rn]7s²', 6 => '7s²' ],
			'Ac' => [ 0 => 89, 1 => 'Actinium', 2 => 'Solid', 3 => 227, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶6d¹7s²', 5 => '[Rn]7s²6d¹', 6 => '7s²6d¹' ],
			'Th' => [ 0 => 90, 1 => 'Thorium', 2 => 'Solid', 3 => 232.04, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶6d²7s²', 5 => '[Rn]7s²6d²', 6 => '7s²6d²' ],
			'Pa' => [ 0 => 91, 1 => 'Protactinium', 2 => 'Solid', 3 => 231.04, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f²6d¹', 5 => '[Rn]7s²5f²6d¹', 6 => '7s²5f²6d¹' ],
			'U' => [ 0 => 92, 1 => 'Uranium', 2 => 'Solid', 3 => 238.03, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f³6d¹', 5 => '[Rn]7s²5f³6d¹', 6 => '7s²5f³6d¹' ],
			'Np' => [ 0 => 93, 1 => 'Neptunium', 2 => 'Solid', 3 => 237, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²6p⁶4f¹⁴5d¹⁰7s²5f⁴6d¹ ', 5 => '[Rn]7s²5f⁴6d¹', 6 => '7s²5f⁴6d¹ ' ],
			'Pu' => [ 0 => 94, 1 => 'Plutonium', 2 => 'Solid', 3 => 244, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²6s²4f¹⁴5d¹⁰6p⁶7s²5f⁶5p⁶', 5 => '[Rn]7s²5f⁶', 6 => '7s²5f⁶' ],
			'Am' => [ 0 => 95, 1 => 'Americium', 2 => 'Solid', 3 => 243, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f⁷', 5 => '[Rn]7s²5f⁷', 6 => '7s²5f⁷' ],
			'Cm' => [ 0 => 96, 1 => 'Curium', 2 => 'Solid', 3 => 247, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f⁷6d¹', 5 => '[Rn]7s²5f⁷6d¹', 6 => '7s²5f⁷6d¹' ],
			'Bk' => [ 0 => 97, 1 => 'Berkelium', 2 => 'Solid', 3 => 247, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f⁹', 5 => '[Rn]7s²5f⁹', 6 => '7s²5f⁹' ],
			'Cf' => [ 0 => 98, 1 => 'Californium', 2 => 'Solid', 3 => 251, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁰', 5 => '[Rn]7s²5f¹⁰', 6 => '7s²5f¹⁰' ],
			'Es' => [ 0 => 99, 1 => 'Einsteinium', 2 => 'Solid', 3 => 252, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹¹', 5 => '[Rn]7s²5f¹¹', 6 => '7s²5f¹¹' ],
			'Fm' => [ 0 => 100, 1 => 'Fermium', 2 => 'Solid', 3 => 257, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹²', 5 => '[Rn]5f¹²7s²', 6 => '5f¹²7s²' ],
			'Md' => [ 0 => 101, 1 => 'Mendelevium', 2 => 'Solid', 3 => 258, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹³', 5 => '[Rn]7s²5f¹³', 6 => '7s²5f¹³' ],
			'No' => [ 0 => 102, 1 => 'Nobelium', 2 => 'Solid', 3 => 259, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴', 5 => '[Rn]7s²5f¹⁴', 6 => '7s²5f¹⁴' ],
			'Lr' => [ 0 => 103, 1 => 'Lawrencium', 2 => 'Solid', 3 => 266, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴7p¹', 5 => '[Rn]7s²5f¹⁴6d¹', 6 => '7s²7p¹' ],
			'Rf' => [ 0 => 104, 1 => 'Rutherfordium', 2 => 'Solid', 3 => 267, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d²', 5 => '[Rn]7s²5f¹⁴6d²', 6 => '7s²6d²' ],
			'Db' => [ 0 => 105, 1 => 'Dubnium', 2 => 'Solid', 3 => 268, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d³', 5 => '[Rn]7s²5f¹⁴6d³', 6 => '7s²6d³' ],
			'Sg' => [ 0 => 106, 1 => 'Seaborgium', 2 => 'Solid', 3 => 269, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d⁴', 5 => '[Rn]7s²5f¹⁴6d⁴', 6 => '7s²6d⁴' ],
			'Bh' => [ 0 => 107, 1 => 'Bohrium', 2 => 'Solid', 3 => 270, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d⁵', 5 => '[Rn]7s²5f¹⁴6d⁵', 6 => '7s²6d⁵' ],
			'Hs' => [ 0 => 108, 1 => 'Hassium', 2 => 'Solid', 3 => 277, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d⁶', 5 => '[Rn]7s²5f¹⁴6d⁶', 6 => '7s²6d⁶' ],
			'Mt' => [ 0 => 109, 1 => 'Meitnerium', 2 => 'Solid', 3 => 278, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d⁷', 5 => '[Rn]7s²5f¹⁴6d⁷', 6 => '7s²6d⁷' ],
			'Ds' => [ 0 => 110, 1 => 'Darmstadtium', 2 => 'Solid (Expected)', 3 => 281, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d⁸', 5 => '[Rn]7s²5f¹⁴6d⁸', 6 => '7s²6d⁸' ],
			'Rg' => [ 0 => 111, 1 => 'Roentgenium', 2 => 'Solid (Expected)', 3 => 282, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d⁹', 5 => '[Rn]7s²5f¹⁴6d⁹', 6 => '7s²6d⁹' ],
			'Cn' => [ 0 => 112, 1 => 'Copernicium', 2 => 'Solid (Expected)', 3 => 285, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶6d¹⁰7s²5f¹⁴', 5 => '[Rn]7s²5f¹⁴6d¹⁰', 6 => '7s²6d¹⁰' ],
			'Nh' => [ 0 => 113, 1 => 'Nihonium', 2 => 'Solid (Expected)', 3 => 286, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d¹⁰7p¹', 5 => '[Rn]5f¹⁴6d¹⁰7s²7p¹', 6 => '7s²7p¹' ],
			'Fl' => [ 0 => 114, 1 => 'Flerovium', 2 => 'Solid (Expected)', 3 => 289, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d¹⁰7p²', 5 => '[Rn]7s²7p²5f¹⁴6d¹⁰', 6 => '7s²7p²' ],
			'Mc' => [ 0 => 115, 1 => 'Moscovium', 2 => 'Solid (Expected)', 3 => 290, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d¹⁰7p³', 5 => '[Rn]7s²7p³5f¹⁴6d¹⁰', 6 => '7s²7p³' ],
			'Lv' => [ 0 => 116, 1 => 'Livermorium', 2 => 'Solid (Expected)', 3 => 293, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d¹⁰7p⁴', 5 => '[Rn]7s²7p⁴5f¹⁴6d¹⁰', 6 => '7s²7p⁴' ],
			'Ts' => [ 0 => 117, 1 => 'Tennessine', 2 => 'Solid (Expected)', 3 => 294, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d¹⁰7p⁵', 5 => '[Rn]7s²7p⁵5f¹⁴6d¹⁰', 6 => '7s²7p⁵' ],
			'Og' => [ 0 => 118, 1 => 'Oganesson', 2 => 'Gas (Expected)', 3 => 294, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s²4p⁶4d¹⁰5s²5p⁶6s²4f¹⁴5d¹⁰6p⁶7s²5f¹⁴6d¹⁰7p⁶', 5 => '[Rn]7s²7p⁶5f¹⁴6d¹⁰', 6 => '7s²7p⁶' ]
		];
		$res='';
		foreach($periodic_table as $key => $value){
			if($key===$element){
				$res=$value;
			}
		}
		if(empty($res)){
			$this->param['error'] = 'Please! Check Your Input.';
			return $this->param;	
		}
		$this->param['res']=$res;
		$this->param['RESULT'] = 1;

		return $this->param;
	}else{
		$this->param['error'] = 'Please! Check Your Input.';
		return $this->param;
	}
}
    // public function electron($request){
    //     $element=$request->element;

	// 	if (!empty($element)) {
	// 		$format = '{
	// 			"steps": [
	// 				"<p class="mt-3">steps here</p>",
	// 				// continue for more steps
	// 			]
	// 		}';
	// 		$prompt = "Use the electronic configuration calculator to calculate the electronic configuration of the input '$element', such that:
	// 		This given input can either be an atomic number, a periodic symbol that is present in the periodic table, the full name of the element, or the electronic configuration of the element. Calculate exact information as per the established IUPAC rules based on the Aufbau principle, Hund's rule, and the Pauli exclusion principle without any mistakes. If the element has not been discovered so far, consider it hypothetical accurately. Include both the “Aufbau configuration” and “Expanded form.” Also, give the correct name of the element according to the periodic table.
	// 		If there is an exception for this element, please present that information at the top of your answer, followed by a detailed explanation of the other calculations below.
	// 		Additionally, calculate the following:
	// 		Maximum Principal Quantum Number
	// 		Atomic Radius
	// 		Atomic Mass
	// 		Maximum Azimuthal Quantum Number (In format: 1=s, ...)
	// 		Total Number of Electrons
	// 		Capacity of every subshell (Write all in one line, separated by a comma)
	// 		Largest Core (including configuration and element name)
	// 		Valence Subshell Configuration
	// 		Last Subshell (as per the Expanded form calculated above)
	// 		Show the user input, Electronic configuration, and all other headings in the form of heading must be formatted in KaTeX at the top of the concerned result.
	// 		$$ textbf{Your Input: }$$
	// 		Errors to avoid:
	// 		Do not include “#, –, **,” or any other symbol at the start of any step.
	// 		Note: You must provide each step as an independent block in KaTeX, with each equation or result on a single line. Avoid providing additional explanations of the steps. Must ensure that the output is accurate and formatted properly.
	// 		";
	// 		$client = new Client();
	// 		$response = $client->post('https://api.openai.com/v1/chat/completions', [
	// 			'headers' => [
	// 				'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
	// 				'Content-Type' => 'application/json'
	// 			],
	// 			'json' => [
	// 				"model" => "gpt-4o-mini",
	// 				"response_format" => [
	// 					"type" => "text"
	// 				],
	// 				"max_tokens" => 3000,
	// 				"messages" => [
	// 					[
	// 						"role" => "user",
	// 						"content" => $prompt
	// 					]
	// 				]
	// 			]
	// 		]);

	// 		$data = json_decode($response->getBody()->getContents(), true);
	// 		$dataArray = $data['choices'][0]['message']['content'];
	// 		$this->param['dataArray'] = $dataArray;
	// 		return $this->param;
	// 	}else{
	// 		$this->param['error'] = 'Please! Add at least 2 Element and its Percentage of Mass.';
	// 		return $this->param;
	// 	}
        // if(preg_match("/\<|\>|\&|[0-9]|php|print_r|print|echo|script|=|sin|cos|tan|arcsin|arccos|arctan|&|%/i",$element)){
        //     $this->param['error'] = 'Please Enter Valid Input.';
        //     return $this->param;
        // }

        // if(!empty($element)){
        //     $periodic_table = [
        //         'H' => [ 0 => 1, 1 => 'Hydrogen', 2 => 'Gas', 3 => 1.008, 4 => '1s¹', 5 => 'N/A' ],
        //         'He' => [ 0 => 2, 1 => 'Helium', 2 => 'Gas', 3 => 4.0026, 4 => '1s²', 5 => 'N/A' ],
        //         'Li' => [ 0 => 3, 1 => 'Lithium', 2 => 'Solid', 3 => 6.94, 4 => '1s²2s¹', 5 => '[He]2s¹' ],
        //         'Be' => [ 0 => 4, 1 => 'Beryllium', 2 => 'Solid', 3 => 9.0122, 4 => '1s²2s²', 5 => '[He]2s²' ],
        //         'B' => [ 0 => 5, 1 => 'Boron', 2 => 'Solid', 3 => 10.81, 4 => '1s²2s²2p¹', 5 => '[He]2s²2p¹' ],
        //         'C' => [ 0 => 6, 1 => 'Carbon', 2 => 'Solid', 3 => 12.011, 4 => '1s²2s²2p²', 5 => '[He]2s²2p²' ],
        //         'N' => [ 0 => 7, 1 => 'Nitrogen', 2 => 'Gas', 3 => 14.007, 4 => '1s²2s²2p³', 5 => '[He]2s²2p³' ],
        //         'O' => [ 0 => 8, 1 => 'Oxygen', 2 => 'Gas', 3 => 15.999, 4 => '1s²2s²2p⁴', 5 => '[He]2s²2p⁴' ],
        //         'F' => [ 0 => 9, 1 => 'Fluorine', 2 => 'Gas', 3 => 18.998, 4 => '1s²2s²2p⁵', 5 => '[He]2s²2p⁵' ],
        //         'Ne' => [ 0 => 10, 1 => 'Neon', 2 => 'Gas', 3 => 20.180, 4 => '1s²2s²2p⁶', 5 => '[He]2s²2p⁶' ],
        //         'Na' => [ 0 => 11, 1 => 'Sodium', 2 => 'Solid', 3 => 22.990, 4 => '1s²2s²2p⁶3s¹', 5 => '[Ne]3s¹' ],
        //         'Mg' => [ 0 => 12, 1 => 'Magnesium', 2 => 'Solid', 3 => 24.305, 4 => '1s²2s²2p⁶3s²', 5 => '[Ne]3s²' ],
        //         'Al' => [ 0 => 13, 1 => 'Aluminum', 2 => 'Solid', 3 => 26.982, 4 => '1s²2s²2p⁶3s²3p¹', 5 => '[Ne]3s²3p¹' ],
        //         'Si' => [ 0 => 14, 1 => 'Silicon', 2 => 'Solid', 3 => 28.085, 4 => '1s²2s²2p⁶3s²3p²', 5 => '[Ne]3s²3p²' ],
        //         'P' => [ 0 => 15, 1 => 'Phosphorus', 2 => 'Solid', 3 => 30.974, 4 => '1s²2s²2p⁶3s²3p³', 5 => '[Ne]3s²3p³' ],
        //         'S' => [ 0 => 16, 1 => 'Sulfur', 2 => 'Solid', 3 => 32.06, 4 => '1s²2s²2p⁶3s²3p⁴', 5 => '[Ne]3s²3p⁴' ],
        //         'Cl' => [ 0 => 17, 1 => 'Chlorine', 2 => 'Gas', 3 => 35.45, 4 => '1s²2s²2p⁶3s²3p⁵', 5 => '[Ne]3s²3p⁵' ],
        //         'Ar' => [ 0 => 18, 1 => 'Argon', 2 => 'Gas', 3 => 39.948, 4 => '1s²2s²2p⁶3s²3p⁶', 5 => '[Ne]3s²3p⁶' ],
        //         'K' => [ 0 => 19, 1 => 'Potassium', 2 => 'Solid', 3 => 39.098, 4 => '1s²2s²2p⁶3s²3p⁶4s¹', 5 => '[Ar]4s¹' ],
        //         'Ca' => [ 0 => 20, 1 => 'Calcium', 2 => 'Solid', 3 => 40.078, 4 => '1s²2s²2p⁶3s²3p⁶4s²', 5 => '[Ar]4s²' ],
        //         'Sc' => [ 0 => 21, 1 => 'Scandium', 2 => 'Solid', 3 => 44.956, 4 => '1s²2s²2p⁶3s²3p⁶3d¹4s²', 5 => '[Ar]4s²3d¹' ],
        //         'Ti' => [ 0 => 22, 1 => 'Titanium', 2 => 'Solid', 3 => 47.867, 4 => '1s²2s²2p⁶3s²3p⁶3d²4s²', 5 => '[Ar]4s²3d²' ],
        //         'V' => [ 0 => 23, 1 => 'Vanadium', 2 => 'Solid', 3 => 50.942, 4 => '1s²2s²2p⁶3s²3p⁶3d³4s²', 5 => '[Ar]4s²3d³' ],
        //         'Cr' => [ 0 => 24, 1 => 'Chromium', 2 => 'Solid', 3 => 51.996, 4 => '1s²2s²2p⁶3s²3p⁶3d⁵4s¹', 5 => '[Ar]3d⁵4s¹' ],
        //         'Mn' => [ 0 => 25, 1 => 'Manganese', 2 => 'Solid', 3 => 54.938, 4 => '1s²2s²2p⁶3s²3p⁶3d⁵4s²', 5 => '[Ar]4s²3d⁵' ],
        //         'Fe' => [ 0 => 26, 1 => 'Iron', 2 => 'Solid', 3 => 55.845, 4 => '1s²2s²2p⁶3s²3p⁶3d64s²', 5 => '[Ar]4s²3d⁶' ],
        //         'Co' => [ 0 => 27, 1 => 'Cobalt', 2 => 'Solid', 3 => 58.933, 4 => '1s²2s²2p⁶3s²3p⁶3d⁷4s²', 5 => '[Ar]4s²3d⁷' ],
        //         'Ni' => [ 0 => 28, 1 => 'Nickel', 2 => 'Solid', 3 => 58.693, 4 => '1s²2s²2p⁶3s²3p⁶3d⁸4s²', 5 => '[Ar]4s²3d⁸' ],
        //         'Cu' => [ 0 => 29, 1 => 'Copper', 2 => 'Solid', 3 => 63.546, 4 => '1s²2s²2p⁶3s²3p⁶3d¹⁰4s¹', 5 => '[Ar]4s¹3d¹⁰' ],
        //         'Zn' => [ 0 => 30, 1 => 'Zinc', 2 => 'Solid', 3 => 65.38, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰', 5 => '[Ar]4s²3d¹⁰' ],
        //         'Ga' => [ 0 => 31, 1 => 'Gallium', 2 => 'Solid', 3 => 69.723, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p¹', 5 => '[Ar]4s²3d¹⁰4p¹' ],
        //         'Ge' => [ 0 => 32, 1 => 'Germanium', 2 => 'Solid', 3 => 72.630, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p²', 5 => '[Ar]4s²3d¹⁰4p²' ],
        //         'As' => [ 0 => 33, 1 => 'Arsenic', 2 => 'Solid', 3 => 74.922, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p³', 5 => '[Ar]4s²3d¹⁰4p³' ],
        //         'Se' => [ 0 => 34, 1 => 'Selenium', 2 => 'Solid', 3 => 78.971, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁴', 5 => '[Ar]4s²3d¹⁰4p⁴' ],
        //         'Br' => [ 0 => 35, 1 => 'Bromine', 2 => 'Liquid', 3 => 79.904, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁵', 5 => '[Ar]4s²3d¹⁰4p⁵' ],
        //         'Kr' => [ 0 => 36, 1 => 'Krypton', 2 => 'Gas', 3 => 83.798, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶', 5 => '[Ar]4s²3d¹⁰4p⁶' ],
        //         'Rb' => [ 0 => 37, 1 => 'Rubidium', 2 => 'Solid', 3 => 85.468, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶5s¹', 5 => '[Kr]5s¹' ],
        //         'Sr' => [ 0 => 38, 1 => 'Strontium', 2 => 'Solid', 3 => 87.62, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶5s²', 5 => '[Kr]5s²' ],
        //         'Y' => [ 0 => 39, 1 => 'Yttrium', 2 => 'Solid', 3 => 88.906, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹5s²', 5 => '[Kr]5s²4d¹' ],
        //         'Zr' => [ 0 => 40, 1 => 'Zirconium', 2 => 'Solid', 3 => 91.224, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d²5s²', 5 => '[Kr]5s²4d²' ],
        //         'Nb' => [ 0 => 41, 1 => 'Niobium', 2 => 'Solid', 3 => 92.906, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d45s¹', 5 => '[Kr]5s¹4d⁴' ],
        //         'Mo' => [ 0 => 42, 1 => 'Molybdenum', 2 => 'Solid', 3 => 95.95, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d⁵5s¹', 5 => '[Kr]5s¹4d⁵' ],
        //         'Tc' => [ 0 => 43, 1 => 'Technetium', 2 => 'Solid', 3 => 98, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d⁵5s²', 5 => '[Kr]5s²4d⁵' ],
        //         'Ru' => [ 0 => 44, 1 => 'Ruthenium', 2 => 'Solid', 3 => 101.07, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d⁷5s¹', 5 => '[Kr]5s¹4d⁷' ],
        //         'Rh' => [ 0 => 45, 1 => 'Rhodium', 2 => 'Solid', 3 => 102.91, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d⁸5s¹', 5 => '[Kr]5s¹4d⁸' ],
        //         'Pd' => [ 0 => 46, 1 => 'Palladium', 2 => 'Solid', 3 => 106.42, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰', 5 => '[Kr]4d¹⁰' ],
        //         'Ag' => [ 0 => 47, 1 => 'Silver', 2 => 'Solid', 3 => 107.87, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s¹', 5 => '[Kr]5s¹4d¹⁰' ],
        //         'Cd' => [ 0 => 48, 1 => 'Cadmium', 2 => 'Solid', 3 => 112.41, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²', 5 => '[Kr]5s²4d¹⁰' ],
        //         'In' => [ 0 => 49, 1 => 'Indium', 2 => 'Solid', 3 => 114.82, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p¹', 5 => '[Kr]5s²4d¹⁰5p¹' ],
        //         'Sn' => [ 0 => 50, 1 => 'Tin', 2 => 'Solid', 3 => 118.71, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p²', 5 => '[Kr]5s²4d¹⁰5p²' ],
        //         'Sb' => [ 0 => 51, 1 => 'Antimony', 2 => 'Solid', 3 => 121.76, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p³', 5 => '[Kr]5s²4d¹⁰5p³' ],
        //         'Te' => [ 0 => 52, 1 => 'Tellurium', 2 => 'Solid', 3 => 127.60, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁴', 5 => '[Kr]5s²4d¹⁰5p⁴' ],
        //         'I' => [ 0 => 53, 1 => 'Iodine', 2 => 'Solid', 3 => 126.90, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁵', 5 => '[Kr]5s²4d¹⁰5p⁵' ],
        //         'Xe' => [ 0 => 54, 1 => 'Xenon', 2 => 'Gas', 3 => 131.29, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶', 5 => '[Kr]5s²4d¹⁰5p⁶' ],
        //         'Cs' => [ 0 => 55, 1 => 'Cesium', 2 => 'Solid', 3 => 132.91, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s¹', 5 => '[Xe]6s¹' ],
        //         'Ba' => [ 0 => 56, 1 => 'Barium', 2 => 'Solid', 3 => 137.33, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶6s²', 5 => '[Xe]6s²' ],
        //         'La' => [ 0 => 57, 1 => 'Lanthanum', 2 => 'Solid', 3 => 138.91, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰5s²5p⁶5d¹6s²', 5 => '[Xe]6s²5d¹' ],
        //         'Ce' => [ 0 => 58, 1 => 'Cerium', 2 => 'Solid', 3 => 140.12, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹5s²5p⁶5d¹6s²', 5 => '[Xe]6s²4f¹5d¹' ],
        //         'Pr' => [ 0 => 59, 1 => 'Praseodymium', 2 => 'Solid', 3 => 140.91, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f³5s²5p⁶6s²', 5 => '[Xe]6s²4f³' ],
        //         'Nd' => [ 0 => 60, 1 => 'Neodymium', 2 => 'Solid', 3 => 144.24, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f⁴5s²5p⁶6s²', 5 => '[Xe]6s²4f⁴' ],
        //         'Pm' => [ 0 => 61, 1 => 'Promethium', 2 => 'Solid', 3 => 145, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f⁵5s²5p⁶6s²', 5 => '[Xe]6s²4f⁵' ],
        //         'Sm' => [ 0 => 62, 1 => 'Samarium', 2 => 'Solid', 3 => 150.36, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f⁶5s²5p⁶6s²', 5 => '[Xe]6s²4f⁶' ],
        //         'Eu' => [ 0 => 63, 1 => 'Europium', 2 => 'Solid', 3 => 151.96, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f⁷5s²5p⁶6s²', 5 => '[Xe]6s²4f⁷' ],
        //         'Gd' => [ 0 => 64, 1 => 'Gadolinium', 2 => 'Solid', 3 => 157.25, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f⁷5s²5p⁶5d¹6s²', 5 => '[Xe]6s²4f⁷5d¹' ],
        //         'Tb' => [ 0 => 65, 1 => 'Terbium', 2 => 'Solid', 3 => 158.93, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f⁹5s²5p⁶6s²', 5 => '[Xe]6s²4f⁹' ],
        //         'Dy' => [ 0 => 66, 1 => 'Dysprosium', 2 => 'Solid', 3 => 162.50, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁰5s²5p⁶6s²', 5 => '[Xe]6s²4f¹⁰' ],
        //         'Ho' => [ 0 => 67, 1 => 'Holmium', 2 => 'Solid', 3 => 164.93, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹¹5s²5p⁶6s²', 5 => '[Xe]6s²4f¹¹' ],
        //         'Er' => [ 0 => 68, 1 => 'Erbium', 2 => 'Solid', 3 => 167.26, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹²5s²5p⁶6s²', 5 => '[Xe]6s²4f¹²' ],
        //         'Tm' => [ 0 => 69, 1 => 'Thulium', 2 => 'Solid', 3 => 168.93, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹³5s²5p⁶6s²', 5 => '[Xe]6s²4f¹³' ],
        //         'Yb' => [ 0 => 70, 1 => 'Ytterbium', 2 => 'Solid', 3 => 173.05, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶6s²', 5 => '[Xe]6s²4f¹⁴' ],
        //         'Lu' => [ 0 => 71, 1 => 'Lutetium', 2 => 'Solid', 3 => 174.97, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹6s²', 5 => '[Xe]6s²4f¹⁴5d¹' ],
        //         'Hf' => [ 0 => 72, 1 => 'Hafnium', 2 => 'Solid', 3 => 178.49, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d²6s²', 5 => '[Xe]6s²4f¹⁴5d²' ],
        //         'Ta' => [ 0 => 73, 1 => 'Tantalum', 2 => 'Solid', 3 => 180.95, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d³6s²', 5 => '[Xe]6s²4f¹⁴5d³' ],
        //         'W' => [ 0 => 74, 1 => 'Tungsten', 2 => 'Solid', 3 => 183.84, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d46s²', 5 => '[Xe]6s²4f¹⁴5d⁴' ],
        //         'Re' => [ 0 => 75, 1 => 'Rhenium', 2 => 'Solid', 3 => 186.21, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d⁵6s²', 5 => '[Xe]6s²4f¹⁴5d⁵' ],
        //         'Os' => [ 0 => 76, 1 => 'Osmium', 2 => 'Solid', 3 => 190.23, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d66s²', 5 => '[Xe]6s²4f¹⁴5d⁶' ],
        //         'Ir' => [ 0 => 77, 1 => 'Iridium', 2 => 'Solid', 3 => 192.22, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d⁷6s²', 5 => '[Xe]6s²4f¹⁴5d⁷' ],
        //         'Pt' => [ 0 => 78, 1 => 'Platinum', 2 => 'Solid', 3 => 195.08, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d⁹6s¹', 5 => '[Xe]6s¹4f¹⁴5d⁹' ],
        //         'Au' => [ 0 => 79, 1 => 'Gold', 2 => 'Solid', 3 => 196.97, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s¹', 5 => '[Xe]6s¹4f¹⁴5d¹⁰' ],
        //         'Hg' => [ 0 => 80, 1 => 'Mercury', 2 => 'Solid', 3 => 200.59, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²', 5 => '[Xe]6s²4f¹⁴5d¹⁰' ],
        //         'Tl' => [ 0 => 81, 1 => 'Thallium', 2 => 'Solid', 3 => 204.38, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p¹', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p¹' ],
        //         'Pb' => [ 0 => 82, 1 => 'Lead', 2 => 'Solid', 3 => 207.2, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p²', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p²' ],
        //         'Bi' => [ 0 => 83, 1 => 'Bismuth', 2 => 'Solid', 3 => 208.98, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p³', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p³' ],
        //         'Po' => [ 0 => 84, 1 => 'Polonium', 2 => 'Solid', 3 => 209, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p⁴', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p⁴' ],
        //         'At' => [ 0 => 85, 1 => 'Astatine', 2 => 'Solid', 3 => 210, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p⁵', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p⁵' ],
        //         'Rn' => [ 0 => 86, 1 => 'Radon', 2 => 'Gas', 3 => 222, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p⁶', 5 => '[Xe]6s²4f¹⁴5d¹⁰6p⁶' ],
        //         'Fr' => [ 0 => 87, 1 => 'Francium', 2 => 'Solid', 3 => 223, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p⁶7s¹', 5 => '[Rn]7s¹' ],
        //         'Ra' => [ 0 => 88, 1 => 'Radium', 2 => 'Solid', 3 => 226, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p⁶7s²', 5 => '[Rn]7s²' ],
        //         'Ac' => [ 0 => 89, 1 => 'Actinium', 2 => 'Solid', 3 => 227, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p⁶6d¹7s²', 5 => '[Rn]7s²6d¹' ],
        //         'Th' => [ 0 => 90, 1 => 'Thorium', 2 => 'Solid', 3 => 232.04, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰6s²6p⁶6d²7s²', 5 => '[Rn]7s²6d²' ],
        //         'Pa' => [ 0 => 91, 1 => 'Protactinium', 2 => 'Solid', 3 => 231.04, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f26s²6p⁶6d¹7s²', 5 => '[Rn]7s²5f²6d¹' ],
        //         'U' => [ 0 => 92, 1 => 'Uranium', 2 => 'Solid', 3 => 238.03, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f³6s²6p⁶6d¹7s²', 5 => '[Rn]7s²5f³6d¹' ],
        //         'Np' => [ 0 => 93, 1 => 'Neptunium', 2 => 'Solid', 3 => 237, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f⁴6s²6p⁶6d¹7s² ', 5 => '[Rn]7s²5f⁴6d¹' ],
        //         'Pu' => [ 0 => 94, 1 => 'Plutonium', 2 => 'Solid', 3 => 244, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f⁶6s²6p⁶7s²', 5 => '[Rn]7s²5f⁶' ],
        //         'Am' => [ 0 => 95, 1 => 'Americium', 2 => 'Solid', 3 => 243, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f⁷6s²6p⁶7s²', 5 => '[Rn]7s²5f⁷' ],
        //         'Cm' => [ 0 => 96, 1 => 'Curium', 2 => 'Solid', 3 => 247, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f⁷6s²6p⁶6d¹7s²', 5 => '[Rn]7s²5f⁷6d¹' ],
        //         'Bk' => [ 0 => 97, 1 => 'Berkelium', 2 => 'Solid', 3 => 247, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f⁹6s²6p⁶7s²', 5 => '[Rn]7s²5f⁹' ],
        //         'Cf' => [ 0 => 98, 1 => 'Californium', 2 => 'Solid', 3 => 251, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁰6s²6p⁶7s²', 5 => '[Rn]7s²5f¹⁰' ],
        //         'Es' => [ 0 => 99, 1 => 'Einsteinium', 2 => 'Solid', 3 => 252, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹¹6s²6p⁶7s²', 5 => '[Rn]7s²5f¹¹' ],
        //         'Fm' => [ 0 => 100, 1 => 'Fermium', 2 => 'Solid', 3 => 257, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹²6s²6p⁶7s²', 5 => '[Rn]5f¹²7s²' ],
        //         'Md' => [ 0 => 101, 1 => 'Mendelevium', 2 => 'Solid', 3 => 258, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹³6s²6p⁶7s²', 5 => '[Rn]7s²5f¹³' ],
        //         'No' => [ 0 => 102, 1 => 'Nobelium', 2 => 'Solid', 3 => 259, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶7s²', 5 => '[Rn]7s²5f¹⁴' ],
        //         'Lr' => [ 0 => 103, 1 => 'Lawrencium', 2 => 'Solid', 3 => 266, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶7s²7p¹', 5 => '[Rn]7s²5f¹⁴6d¹' ],
        //         'Rf' => [ 0 => 104, 1 => 'Rutherfordium', 2 => 'Solid', 3 => 267, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d²7s²', 5 => '[Rn]7s²5f¹⁴6d²' ],
        //         'Db' => [ 0 => 105, 1 => 'Dubnium', 2 => 'Solid', 3 => 268, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d³7s²', 5 => '[Rn]7s²5f¹⁴6d³' ],
        //         'Sg' => [ 0 => 106, 1 => 'Seaborgium', 2 => 'Solid', 3 => 269, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d47s²', 5 => '[Rn]7s²5f¹⁴6d⁴' ],
        //         'Bh' => [ 0 => 107, 1 => 'Bohrium', 2 => 'Solid', 3 => 270, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d⁵7s²', 5 => '[Rn]7s²5f¹⁴6d⁵' ],
        //         'Hs' => [ 0 => 108, 1 => 'Hassium', 2 => 'Solid', 3 => 277, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d67s²', 5 => '[Rn]7s²5f¹⁴6d⁶' ],
        //         'Mt' => [ 0 => 109, 1 => 'Meitnerium', 2 => 'Solid', 3 => 278, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d⁷7s²', 5 => '[Rn]7s²5f¹⁴6d⁷' ],
        //         'Ds' => [ 0 => 110, 1 => 'Darmstadtium', 2 => 'Solid (Expected)', 3 => 281, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d⁸7s²', 5 => '[Rn]7s²5f¹⁴6d⁸' ],
        //         'Rg' => [ 0 => 111, 1 => 'Roentgenium', 2 => 'Solid (Expected)', 3 => 282, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d⁹7s²', 5 => '[Rn]7s²5f¹⁴6d⁹' ],
        //         'Cn' => [ 0 => 112, 1 => 'Copernicium', 2 => 'Solid (Expected)', 3 => 285, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d¹⁰7s²', 5 => '[Rn]7s²5f¹⁴6d¹⁰' ],
        //         'Nh' => [ 0 => 113, 1 => 'Nihonium', 2 => 'Solid (Expected)', 3 => 286, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d¹⁰7s²7p¹', 5 => '[Rn]5f¹⁴6d¹⁰7s²7p¹' ],
        //         'Fl' => [ 0 => 114, 1 => 'Flerovium', 2 => 'Solid (Expected)', 3 => 289, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d¹⁰7s²7p²', 5 => '[Rn]7s²7p²5f¹⁴6d¹⁰' ],
        //         'Mc' => [ 0 => 115, 1 => 'Moscovium', 2 => 'Solid (Expected)', 3 => 290, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d¹⁰7s²7p³', 5 => '[Rn]7s²7p³5f¹⁴6d¹⁰' ],
        //         'Lv' => [ 0 => 116, 1 => 'Livermorium', 2 => 'Solid (Expected)', 3 => 293, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d¹⁰7s²7p⁴', 5 => '[Rn]7s²7p⁴5f¹⁴6d¹⁰' ],
        //         'Ts' => [ 0 => 117, 1 => 'Tennessine', 2 => 'Solid (Expected)', 3 => 294, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d¹⁰7s²7p⁵', 5 => '[Rn]7s²7p⁵5f¹⁴6d¹⁰' ],
        //         'Og' => [ 0 => 118, 1 => 'Oganesson', 2 => 'Gas (Expected)', 3 => 294, 4 => '1s²2s²2p⁶3s²3p⁶4s²3d¹⁰4p⁶4d¹⁰4f¹⁴5s²5p⁶5d¹⁰5f¹⁴6s²6p⁶6d¹⁰7s²7p⁶', 5 => '[Rn]7s²7p⁶5f¹⁴6d¹⁰' ]
        //     ];

        //     $res='';
        //     foreach($periodic_table as $key => $value){
        //         if($key===$element){
        //             $res=$value;
        //         }
        //     }
		// 	if(empty($res)){
		// 		$this->param['error'] = 'Please! Check Your Input.';
        //     	return $this->param;	
		// 	}
        //     $this->param['res']=$res;
        //     $this->param['RESULT'] = 1;
        //     return $this->param;
        // }else{
        //     $this->param['error'] = 'Please! Check Your Input.';
        //     return $this->param;
        // }
    // }

    // Chemical Equation Balancer Calculator
	public function chemical($request){
		//  dd($request->all());
		$eq=$request->eq;
		if (preg_match("/\<|\&|php|print_r|print|echo|script|%/i", $eq)) {
			$this->param['error'] = 'Please Enter Valid Input.';
			return $this->param;
		}		
	    if(!empty($eq)){
            $parem=$eq;
            $parem=str_replace(' ', '', $parem);
            $parem = str_replace(['→', '->'], '=', $parem);
            $parem=str_replace('%20', '', $parem);
            $parem=str_replace('+', 'plus' , $parem);
            $parem=str_replace('{', '(', $parem);
            $parem=str_replace('}', ')', $parem);
            $parem=str_replace('^', '**', $parem);
            $exp=explode('=',$parem);
            $r=$exp[0];
            $p=$exp[1];
            $option=2;
            try{
				$response = Http::timeout(120)->get('http://167.172.134.148/limiting', [
                    'r' => $r,
                    'p' => $p,
                ]);
				if ($response->failed()) {
					$this->param['error'] = 'Please! Check Your Equation.';
					return $this->param;
				}
                $buffer = $response->body();
                $buffer = explode('@@@', $buffer);
                $inp=str_replace('plus', '+', $parem);
                $this->param['inp'] = $inp;
                $this->param['be'] = $buffer[0];
                $this->param['mols'] = $buffer[1];
                $this->param['atoms'] = $buffer[2];
                $this->param['chemical_equation'] = str_replace(['→', '->'], '=', $eq);
                $this->param['option'] = $option;
                $this->param['RESULT'] = 1;
                return $this->param;
            }catch (\Exception $response){
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
	    }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
	    } 
    }

    // Molar Mass Calculator
    public function molar($request){
        $f=trim($request->f);

        if(preg_match("/\<|\>|\&|php|print_r|print|echo|script|sin|cos|tan|arcsin|arccos|arctan|&|%/i",$f)){
            $this->param['error'] = 'Please Enter Valid Input.';
            return $this->param;
        }

        if(!empty($f)){
            $parem=$f;
            $parem=str_replace(' ', '', $parem);
            $parem=str_replace('%20', '', $parem);
            $parem=str_replace('+', 'plus', $parem);
            $parem=str_replace('{', '(', $parem);
            $parem=str_replace('}', ')', $parem);
            $parem=str_replace('e^', 'exp', $parem);
            $parem=str_replace('exp^', 'exp', $parem);
            $parem=str_replace('^', '**', $parem);
            $parem=str_replace('e^sqrt(x)', 'exp(2*x)', $parem);
            
            try{
                $response = Http::timeout(120)->get('http://167.172.134.148/molar', [
                    'f' => $parem
                ]);
                $buffer = $response->body();
                $buffer = explode('@@@', $buffer);
                
                $mass=$buffer[2];
                $atoms=$buffer[5];
                $elem=$buffer[6];
                $elem=explode('###',$elem);
                $mm=$buffer[7];
                $mm=explode('###',$mm);
                $num=$buffer[8];
                $num=explode('###',$num);
                $rm=$buffer[9];
                $rm=explode('###',$rm);
                $frac=$buffer[10];
                $t_mm=$buffer[11];
                $frac=explode('###',$frac);
                $table="<table class='col-12' cellspacing='0'><thead><tr><th class='text-start border-b py-2 pe-2'>Element</th><th class='text-start border-b py-2 pe-2'>No. of Atoms</th><th class='text-start border-b py-2 pe-2'>Molar Mass (MM)</th><th class='text-start border-b py-2 pe-2'>Subtotal Mass</th class='text-start border-b py-2 pe-2'><th class='text-start border-b py-2'>Subtotal Mass</th></tr></thead><tbody>";
                $table.="<tr><td class='border-b py-2'>&nbsp;</td><td class='border-b py-2'>&nbsp;</td><td class='border-b py-2'>(g/mol)</td><td class='border-b py-2'>(%)</td><td class='border-b py-2'>(g/mol)</td></tr>";
                for($i=0; $i < count($elem)-1; $i++){
                    $table.="<tr><td class='border-b py-2'>".$elem[$i]."</td><td class='border-b py-2'>".$num[$i]."</td><td class='border-b py-2'>".round($mm[$i],4)."</td><td class='border-b py-2'>".round($frac[$i],2)."</td><td class='border-b py-2'>".round($rm[$i],4)."</td></tr>";
                }
                $table.="<tr><th class='text-start py-2'>Total</th><th class='text-start py-2'>$atoms</th><th class='text-start py-2'>".round($t_mm,4)."</th><th class='text-start py-2'>100.00</th><th class='text-start py-2'>".round($mass,4)."</th></tr></tbody></table>";

                $this->param['hill'] = $buffer[0];
                $this->param['emp'] = $buffer[1];
                $this->param['mass'] = round($mass,4);
                $this->param['n_mass'] = round($buffer[3],4);
                $this->param['m_mass'] = round($buffer[4],4);
                $this->param['atoms'] = $atoms;
                $this->param['table'] = $table;
                $this->param['elem'] = $elem;
                $this->param['frac'] = $frac;
                $this->param['RESULT'] = 1;

                return $this->param;
            } catch (\Exception $response) {
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Titration Calculator
    public function titration($request){
		//  dd($request->all());
        $cal=trim($request->cal);
        $ma=trim($request->ma);
        $ma_unit=trim($request->ma_unit);
        $va=trim($request->va);
        $va_unit=trim($request->va_unit);
        $mb=trim($request->mb);
        $mb_unit=trim($request->mb_unit);
        $vb=trim($request->vb);
        $vb_unit=trim($request->vb_unit);
        $hp=trim($request->hp);
        $oh=trim($request->oh);

        if(is_numeric($ma) && is_numeric($va) && is_numeric($mb) && is_numeric($vb) && is_numeric($hp) && is_numeric($oh)){
            if(is_numeric($ma)){
                if($ma_unit==='pM'){
                    $ma=$ma*0.000000000001;
                }elseif($ma_unit==='nM'){
                    $ma=$ma*0.000000001;
                }elseif($ma_unit==='μM'){
                    $ma=$ma*0.000001;
                }elseif($ma_unit==='mM'){
                    $ma=$ma*0.001;
                }
            }
            if(is_numeric($va)){
                if ($va_unit === 'mm³') {
					$va = $va * 0.000001;
				} elseif ($va_unit === 'cm³') {
					$va = $va * 0.001;
				} elseif ($va_unit === 'dm³') {
					$va = $va * 1;
				} elseif ($va_unit === 'm³') {
					$va = $va * 1000;
				} elseif ($va_unit === 'cu in') {
					$va = $va * 0.0163871;
				} elseif ($va_unit === 'cu ft') {
					$va = $va * 28.3168;
				} elseif ($va_unit === 'cu yd') {
					$va = $va * 764.555;
				} elseif ($va_unit === 'ml') {
					$va = $va * 0.001;
				} elseif ($va_unit === 'cl') {
					$va = $va * 0.01;
				} elseif ($va_unit === 'l') {
					$va = $va * 1;
				} elseif ($va_unit === 'us gal') {
					$va = $va * 3.78541;
				} elseif ($va_unit === 'uk gal') {
					$va = $va * 4.54609;
				} elseif ($va_unit === 'us fl oz') {
					$va = $va * 0.0295735;
				} elseif ($va_unit === 'uk fl oz') {
					$va = $va * 0.0284131;
				}				
            }
            if(is_numeric($mb)){
                if($mb_unit==='pM'){
                    $mb=$mb*0.000000000001;
                }elseif($mb_unit==='nM'){
                    $mb=$mb*0.000000001;
                }elseif($mb_unit==='μM'){
                    $mb=$mb*0.000001;
                }elseif($mb_unit==='mM'){
                    $mb=$mb*0.001;
                }
            }
            if(is_numeric($vb)){
                if ($vb_unit === 'mm³') {
					$vb = $vb * 0.000001;
				} elseif ($vb_unit === 'cm³') {
					$vb = $vb * 0.001;
				} elseif ($vb_unit === 'dm³') {
					$vb = $vb * 1;
				} elseif ($vb_unit === 'm³') {
					$vb = $vb * 1000;
				} elseif ($vb_unit === 'cu in') {
					$vb = $vb * 0.0163871;
				} elseif ($vb_unit === 'cu ft') {
					$vb = $vb * 28.3168;
				} elseif ($vb_unit === 'cu yd') {
					$vb = $vb * 764.555;
				} elseif ($vb_unit === 'ml') {
					$vb = $vb * 0.001;
				} elseif ($vb_unit === 'cl') {
					$vb = $vb * 0.01;
				} elseif ($vb_unit === 'l') {
					$vb = $vb * 1;
				} elseif ($vb_unit === 'us gal') {
					$vb = $vb * 3.78541;
				} elseif ($vb_unit === 'uk gal') {
					$vb = $vb * 4.54609;
				} elseif ($vb_unit === 'us fl oz') {
					$vb = $vb * 0.0295735;
				} elseif ($vb_unit === 'uk fl oz') {
					$vb = $vb * 0.0284131;
				}				
            }
            if($cal==='ma' && is_numeric($va) && is_numeric($hp) && is_numeric($mb) && is_numeric($vb) && is_numeric($oh)){
                $ma=($oh*$mb*$vb)/($va*$hp);
                $ma_pm=$ma*0.000000000001;
                $ma_nm=$ma*0.000000001;
                $ma_um=$ma*0.000001;
                $ma_mm=$ma*0.001;
                $this->param = [
                    "ans" => $ma.' <span class="text-green font-s-25">M</span>',
                    "ans_pm" => $ma_pm.' pM',
                    "ans_nm" => $ma_nm.' nM',
                    "ans_um" => $ma_um.' μM',
                    "ans_mm" => $ma_mm.' mM',
                ];

                return $this->param;
            }elseif($cal==='va' && is_numeric($ma) && is_numeric($hp) && is_numeric($mb) && is_numeric($vb) && is_numeric($oh)){
                $va=($oh*$mb*$vb)/($ma*$hp);
                $va_nl=$va*0.000000001;
                $va_ul=$va*0.000001;
                $va_ml=$va*0.001;
                $this->param = [
                    'ans' => $va.' <span class="text-green font-s-25">liter</span>',
                    'ans_nl' => $va_nl.' nL',
                    'ans_ul' => $va_ul.' μL',
                    'ans_ml' => $va_ml.' mL',
                ];

                return $this->param;
            }elseif($cal==='hp' && is_numeric($ma) && is_numeric($va) && is_numeric($mb) && is_numeric($vb) && is_numeric($oh)){
                $hp=($oh*$mb*$vb)/($ma*$va);
                $this->param = [
                    'ans' => $hp,
                ];

                return $this->param;
            }elseif($cal==='mb' && is_numeric($ma) && is_numeric($va) && is_numeric($hp) && is_numeric($vb) && is_numeric($oh)){
                $mb=($hp*$ma*$va)/($oh*$vb);
                $mb_pm=$mb*0.000000000001;
                $mb_nm=$mb*0.000000001;
                $mb_um=$mb*0.000001;
                $mb_mm=$mb*0.001;
                $this->param = [
                    'ans' => $mb.' <span class="font-s20">M</span>',
                    'ans_pm' => $mb_pm.' pM',
                    'ans_nm' => $mb_nm.' nM',
                    'ans_um' => $mb_um.' μM',
                    'ans_mm' => $mb_mm.' mM',
                ];

                return $this->param;
            }elseif($cal==='vb' && is_numeric($ma) && is_numeric($va) && is_numeric($hp) && is_numeric($mb) && is_numeric($oh)){
                $vb=($hp*$ma*$va)/($oh*$mb);
                $vb_nl=$vb*0.000000001;
                $vb_ul=$vb*0.000001;
                $vb_ml=$vb*0.001;
                $this->param = [
                    'ans' => $vb.' <span class="font-s20">liter</span>',
                    'ans_nl' => $vb_nl.' nL',
                    'ans_ul' => $vb_ul.' μL',
                    'ans_ml' => $vb_ml.' mL',
                ];

                return $this->param;
            }elseif($cal==='oh' && is_numeric($ma) && is_numeric($va) && is_numeric($hp) && is_numeric($mb) && is_numeric($vb)){
                $oh=($hp*$ma*$va)/($vb*$mb);
                $this->param = [
                    'ans' => $oh,
                ];

                return $this->param;
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Molarity Calculator
    public function molarity($request){
		//  dd($request->all());
        $cal=trim($request->cal);
        $mass=trim($request->mass);
        $mass_unit=trim($request->mass_unit);
        $vol=trim($request->vol);
        $vol_unit=trim($request->vol_unit);
        $conc=trim($request->conc);
        $conc_unit=trim($request->conc_unit);
        $sc=trim($request->sc);
        $sc_unit=trim($request->sc_unit);
        $dc=trim($request->dc);
        $dc_unit=trim($request->dc_unit);
        $dv=trim($request->dv);
        $dv_unit=trim($request->dv_unit);
        $mw=trim($request->mw);

        if(is_numeric($mass) && is_numeric($vol) && is_numeric($conc) && is_numeric($mw) && is_numeric($sc) && is_numeric($dc) && is_numeric($dv)){
            if(is_numeric($mass)){
                if($mass_unit==='pg'){
                    $mass=$mass*0.000000000001;
                }elseif($mass_unit==='ng'){
                    $mass=$mass*0.000000001;
                }elseif($mass_unit==='μg'){
                    $mass=$mass*0.000001;
                }elseif($mass_unit==='mg'){
                    $mass=$mass*0.001;
                }elseif($mass_unit==='kg'){
                    $mass=$mass*1000;
                }
            }
            if(is_numeric($conc)){
                if($conc_unit==='fM'){
                    $conc=$conc*0.000000000000001;
                }elseif($conc_unit==='pM'){
                    $conc=$conc*0.000000000001;
                }elseif($conc_unit==='nM'){
                    $conc=$conc*0.000000001;
                }elseif($conc_unit==='μM'){
                    $conc=$conc*0.000001;
                }elseif($conc_unit==='mM'){
                    $conc=$conc*0.001;
                }
            }
            if(is_numeric($vol)){
                if($vol_unit==='nL'){
                    $vol=$vol*0.000000001;
                }elseif($vol_unit==='μL'){
                    $vol=$vol*0.000001;
                }elseif($vol_unit==='mL'){
                    $vol=$vol*0.001;
                }
            }
            if(is_numeric($sc)){
                if($sc_unit==='fM'){
                    $sc=$sc*0.000000000000001;
                }elseif($sc_unit==='pM'){
                    $sc=$sc*0.000000000001;
                }elseif($sc_unit==='nM'){
                    $sc=$sc*0.000000001;
                }elseif($sc_unit==='μM'){
                    $sc=$sc*0.000001;
                }elseif($sc_unit==='mM'){
                    $sc=$sc*0.001;
                }
            }
            if(is_numeric($dc)){
                if($dc_unit==='fM'){
                    $dc=$dc*0.000000000000001;
                }elseif($dc_unit==='pM'){
                    $dc=$dc*0.000000000001;
                }elseif($dc_unit==='nM'){
                    $dc=$dc*0.000000001;
                }elseif($dc_unit==='μM'){
                    $dc=$dc*0.000001;
                }elseif($dc_unit==='mM'){
                    $dc=$dc*0.001;
                }
            }
            if(is_numeric($dv)){
                if($dv_unit==='nL'){
                    $dv=$dv*0.000000001;
                }elseif($dv_unit==='μL'){
                    $dv=$dv*0.000001;
                }elseif($dv_unit==='mL'){
                    $dv=$dv*0.001;
                }
            }
            if($cal==='mass' && is_numeric($conc) && is_numeric($mw) && is_numeric($vol)){
                $mass=$conc*$vol*$mw;
                $mass_pg=$mass/0.000000000001;
                $mass_ng=$mass/0.000000001;
                $mass_ug=$mass/0.000001;
                $mass_mg=$mass/0.001;
                $mass_kg=$mass/1000000;
                $this->param['ans'] = round($mass_mg,4).' <span class="text-green font-s-25">mg</span>';
                $this->param['ans_pg'] = round($mass_pg,4).' pg';
                $this->param['ans_ng'] = round($mass_ng,4).' ng';
                $this->param['ans_ug'] = round($mass_ug,4).' μg';
                $this->param['ans_g'] = round($mass,4).' g';
                $this->param['ans_kg'] = round($mass_kg,4).' kg';
            }elseif($cal==='vol' && is_numeric($mass) && is_numeric($mw) && is_numeric($conc)){
                $vol=$mass/($conc*$mw);
                $vol_nl=$vol/0.000000001;
                $vol_ul=$vol/0.000001;
                $vol_ml=$vol/0.001;
                $this->param['ans'] = round($vol_ml,4).' <span class="text-green font-s-25">mL</span>';
                $this->param['ans_nl'] = round($vol_nl,4).' nL';
                $this->param['ans_ul'] = round($vol_ul,4).' μL';
                $this->param['ans_l'] = round($vol,4).' L';
            }elseif($cal==='mol' && is_numeric($mass) && is_numeric($mw) && is_numeric($vol)){
                $mol=$mass/($vol*$mw);
                $mol_fm=$mol/0.000000000000001;
                $mol_pm=$mol/0.000000000001;
                $mol_nm=$mol/0.000000001;
                $mol_um=$mol/0.000001;
                $mol_mm=$mol/0.001;
                $this->param['ans'] = round($mol_mm,4).' <span class="text-green font-s-25">mM</span>';
                $this->param['ans_fm'] = round($mol_fm,4).' fM';
                $this->param['ans_pm'] = round($mol_pm,4).' pM';
                $this->param['ans_nm'] = round($mol_nm,4).' nM';
                $this->param['ans_um'] = round($mol_um,4).' μM';
                $this->param['ans_m'] = round($mol,4).' M';
            }elseif($cal==='rv' && is_numeric($sc) && is_numeric($dc) && is_numeric($dv)){
                if($dc>$sc){
                    $this->param['error'] = "Desired Concentration sholudn't be greater than Stock Concentration.";
                    return $this->param;
                }
                $rv=($dc/$sc)*$dv;
                $rv_nl=$rv/0.000000001;
                $rv_ul=$rv/0.000001;
                $rv_ml=$rv/0.001;
                $this->param['ans'] = round($rv_ml,4).' <span class="text-green font-s-25">mL</span>';
                $this->param['ans_nl'] = round($rv_nl,4).' nL';
                $this->param['ans_ul'] = round($rv_ul,4).' μL';
                $this->param['ans_l'] = round($rv,4).' L';
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
            $this->param['RESULT'] = 1;

            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Dilution Calculator
    public function dilution($request){
		//  dd($request->all());
        $cal=trim($request->cal);
        $c1=trim($request->c1);
        $c1_unit=trim($request->c1_unit);
        $v1=trim($request->v1);
        $v1_unit=trim($request->v1_unit);
        $c2=trim($request->c2);
        $c2_unit=trim($request->c2_unit);
        $v2=trim($request->v2);
        $v2_unit=trim($request->v2_unit);

        if(is_numeric($c1) && is_numeric($v1) && is_numeric($c2) && is_numeric($v2)){
            if(is_numeric($c1)){
                if($c1_unit==='fM'){
                    $c1=$c1*0.000000000000001;
                }elseif($c1_unit==='pM'){
                    $c1=$c1*0.000000000001;
                }elseif($c1_unit==='nM'){
                    $c1=$c1*0.000000001;
                }elseif($c1_unit==='μM'){
                    $c1=$c1*0.000001;
                }elseif($c1_unit==='mM'){
                    $c1=$c1*0.001;
                }
            }
            if(is_numeric($v1)){
                if($v1_unit==='nL'){
                    $v1=$v1*0.000000001;
                }elseif($v1_unit==='μL'){
                    $v1=$v1*0.000001;
                }elseif($v1_unit==='mL'){
                    $v1=$v1*0.001;
                }
            }
            if(is_numeric($c2)){
                if($c2_unit==='fM'){
                    $c2=$c2*0.000000000000001;
                }elseif($c2_unit==='pM'){
                    $c2=$c2*0.000000000001;
                }elseif($c2_unit==='nM'){
                    $c2=$c2*0.000000001;
                }elseif($c2_unit==='μM'){
                    $c2=$c2*0.000001;
                }elseif($c2_unit==='mM'){
                    $c2=$c2*0.001;
                }
            }
            if(is_numeric($v2)){
                if($v2_unit==='nL'){
                $v2=$v2*0.000000001;
                }elseif($v2_unit==='μL'){
                $v2=$v2*0.000001;
                }elseif($v2_unit==='mL'){
                $v2=$v2*0.001;
                }
            }
            if($cal==='c1' && is_numeric($v1) && is_numeric($c2) && is_numeric($v2)){
                $c1=($c2*$v2)/$v1;
                $c1_fm=$c1/0.000000000000001;
                $c1_pm=$c1/0.000000000001;
                $c1_nm=$c1/0.000000001;
                $c1_um=$c1/0.000001;
                $c1_mm=$c1/0.001;
                $this->param['ans'] = number_format($c1_mm,4).' <span class="text-green font-s-25">mM</span>';
                $this->param['ans_fm'] = number_format($c1_fm,4).' fM';
                $this->param['ans_pm'] = number_format($c1_pm,4).' pM';
                $this->param['ans_nm'] = number_format($c1_nm,4).' nM';
                $this->param['ans_um'] = number_format($c1_um,4).' μM';
                $this->param['ans_m'] = number_format($c1,4).' M';
            }elseif($cal==='v1' && is_numeric($c1) && is_numeric($c2) && is_numeric($v2)){
                $v1=($c2*$v2)/$c1;
                $v1_nl=$v1/0.000000001;
                $v1_ul=$v1/0.000001;
                $v1_ml=$v1/0.001;
                $this->param['ans'] = number_format($v1_ml,4).' <span class="text-green font-s-25">mL</span>';
                $this->param['ans_nl'] = number_format($v1_nl,4).' nL';
                $this->param['ans_ul'] = number_format($v1_ul,4).' μL';
                $this->param['ans_l'] = number_format($v1,4).' L';
            }elseif($cal==='c2' && is_numeric($c1) && is_numeric($v1) && is_numeric($v2)){
                $c2=($c1*$v1)/$v2;
                $c2_fm=$c2/0.000000000000001;
                $c2_pm=$c2/0.000000000001;
                $c2_nm=$c2/0.000000001;
                $c2_um=$c2/0.000001;
                $c2_mm=$c2/0.001;
                $this->param['ans'] = number_format($c2_mm,4).' <span class="text-green font-s-25">mM</span>';
                $this->param['ans_fm'] = number_format($c2_fm,4).' fM';
                $this->param['ans_pm'] = number_format($c2_pm,4).' pM';
                $this->param['ans_nm'] = number_format($c2_nm,4).' nM';
                $this->param['ans_um'] = number_format($c2_um,4).' μM';
                $this->param['ans_m'] = number_format($c2,4).' M';
            }elseif($cal==='v2' && is_numeric($c1) && is_numeric($v1) && is_numeric($c2)){
                $v2=($c1*$v1)/$c2;
                $v2_nl=$v2/0.000000001;
                $v2_ul=$v2/0.000001;
                $v2_ml=$v2/0.001;
                $this->param['ans'] = number_format($v2_ml,4).' <span class="text-green font-s-25">mL</span>';
                $this->param['ans_nl'] = number_format($v2_nl,4).' nL';
                $this->param['ans_ul'] = number_format($v2_ul,4).' μL';
                $this->param['ans_l'] = number_format($v2,4).' L';
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Half Life Calculator
    public function half($request){
        $submit=trim($request->calculator_name);
        if($submit==='calculator1'){
            $find=trim($request->find);
            $nt=trim($request->nt);
            $n0=trim($request->n0);
            $t=trim($request->t);
            $t1_2=trim($request->t1_2);
        }else{
            $find_by=trim($request->find_by);
            $t_1_2=trim($request->t_1_2);
            $T=trim($request->T);
            $lamda=trim($request->lamda);
        }
        $check = false;

        if($submit==='calculator1'){
            if(is_numeric($nt) && is_numeric($n0) && is_numeric($t) && is_numeric($t1_2)){
                $check = true;
            }
        }else{
            if(is_numeric($t_1_2) && is_numeric($T) && is_numeric($lamda)){
                $check = true;
            }
        }
        if($check === true){
            if($submit==='calculator1'){
                if($find==='nt' && is_numeric($n0) && is_numeric($t) && is_numeric($t1_2)){
                    $s1=$t/$t1_2;
                    $s2=pow(0.5,$s1);
                    $nt=$n0*$s2;
                    $this->param['ans'] = $nt;
                    $this->param['s1'] = $s1;
                    $this->param['s2'] = $s2;
                }elseif($find==='n0' && is_numeric($nt) && is_numeric($t) && is_numeric($t1_2)){
                    $s1=$t/$t1_2;
                    $s2=pow(0.5,$s1);
                    $n0=$nt/$s2;
                    $this->param['ans'] = $n0;
                    $this->param['s1'] = $s1;
                    $this->param['s2'] = $s2;
                }elseif($find==='t' && is_numeric($nt) && is_numeric($n0) && is_numeric($t1_2)){
                    $s1=$nt/$n0;
                    $s2=log($s1);
                    $s3=$t1_2*(log($s1));
                    $s4=-log(2);
                    $t=$s3/($s4);
                    $this->param['ans'] = $t;
                    $this->param['s1'] = $s1;
                    $this->param['s2'] = $s2;
                    $this->param['s3'] = $s3;
                    $this->param['s4'] = $s4;
                }elseif($find==='t1_2' && is_numeric($nt) && is_numeric($n0) && is_numeric($t)){
                    $s1=$nt/$n0;
                    $s2=log($s1);
                    $s3=-log(2);
                    $s4=$t*$s3;
                    $t1_2=$s4/$s2;
                    $this->param['ans'] = $t1_2;
                    $this->param['s1'] = $s1;
                    $this->param['s2'] = $s2;
                    $this->param['s3'] = $s3;
                    $this->param['s4'] = $s4;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
                $this->param['share'] = 'share';
            }else{
                if($find_by==='t_1_2' && is_numeric($t_1_2)){
                    $T=$t_1_2/(log(2));
                    $lamda=(log(2))/$t_1_2;
                    $this->param['t_1_2'] = $t_1_2;
                    $this->param['T'] = $T;
                    $this->param['lamda'] = $lamda;
                }elseif($find_by==='T' && is_numeric($T)){
                    $t_1_2=$T*(log(2));
                    $lamda=(log(2))/$t_1_2;
                    $this->param['t_1_2'] = $t_1_2;
                    $this->param['T'] = $T;
                    $this->param['lamda'] = $lamda;
                }elseif($find_by==='lamda' && is_numeric($lamda)){
                    $t_1_2=(log(2))/$lamda;
                    $T=$t_1_2/(log(2));
                    $this->param['t_1_2'] = $t_1_2;
                    $this->param['T'] = $T;
                    $this->param['lamda'] = $lamda;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Mole Calculator
    public function mole($request){
        $cal=trim($request->cal);
        $mass=trim($request->mass);
        $mass_unit=trim($request->mass_unit);
        $mw=trim($request->mw);
        $moles=trim($request->moles);
        $moles_unit=trim($request->moles_unit);

        if(is_numeric($mass) && is_numeric($mw) && is_numeric($moles)){
            function sigFig($value,$digits){
                if($value===0){
                    $decimalPlaces=$digits-1;
                }elseif($value<0){
                    $decimalPlaces=$digits-floor(log10($value*-1))-1;
                }else{
                    $decimalPlaces=$digits-floor(log10($value))-1;
                }
                $answer=round($value,$decimalPlaces);
                return $answer;
            }
            if(is_numeric($mass)){
                if($mass_unit==='pg'){
                    $mass=$mass*0.000000000001;
                }elseif($mass_unit==='ng'){
                    $mass=$mass*0.000000001;
                }elseif($mass_unit==='μg'){
                    $mass=$mass*0.000001;
                }elseif($mass_unit==='mg'){
                    $mass=$mass*0.001;
                }elseif($mass_unit==='dag'){
                    $mass=$mass*10;
                }elseif($mass_unit==='kg'){
                    $mass=$mass*1000;
                }elseif($mass_unit==='t'){
                    $mass=$mass*1000000;
                }elseif($mass_unit==='oz'){
                    $mass=$mass*28.35;
                }elseif($mass_unit==='lbs'){
                    $mass=$mass*453.6;
                }elseif($mass_unit==='stones'){
                    $mass=$mass*6350;
                }elseif($mass_unit==='US ton'){
                    $mass=$mass*907185;
                }elseif($mass_unit==='Long ton'){
                    $mass=$mass*1016047;
                }elseif($mass_unit==='u'){
                    $mass=$mass/602214000000000000000000;
                }
            }
            if(is_numeric($moles)){
                if($moles_unit==='mM'){
                    $moles=$moles*0.001;
                }elseif($moles_unit==='μM'){
                    $moles=$moles*0.000001;
                }elseif($moles_unit==='nM'){
                    $moles=$moles*0.000000001;
                }elseif($moles_unit==='pM'){
                    $moles=$moles*0.000000000001;
                }
            }
            if($cal==='mass' && is_numeric($mw) && is_numeric($moles)){
                $mass=$mw*$moles;
                $mass_pg=$mass/0.000000000001;
                $mass_ng=$mass/0.000000001;
                $mass_ug=$mass/0.000001;
                $mass_mg=$mass/0.001;
                $mass_dag=$mass/10;
                $mass_kg=$mass/1000;
                $mass_t=$mass/1000000;
                $mass_oz=$mass/28.35;
                $mass_lb=$mass/453.6;
                $mass_stone=$mass/6350;
                $mass_us_ton=$mass/907185;
                $mass_long_ton=$mass/1016047;
                $mass_u=$mass*602214000000000000000000;
                $this->param['ans'] = sigFig($mass,4).' <span class="text-green font-s-25">g</span>';
                $this->param['ans_pg'] = sigFig($mass_pg,4).' pg';
                $this->param['ans_ng'] = sigFig($mass_ng,4).' ng';
                $this->param['ans_ug'] = sigFig($mass_ug,4).' μg';
                $this->param['ans_mg'] = sigFig($mass_mg,4).' mg';
                $this->param['ans_dag'] = sigFig($mass_dag,4).' dag';
                $this->param['ans_kg'] = sigFig($mass_kg,4).' kg';
                $this->param['ans_t'] = sigFig($mass_t,4).' t';
                $this->param['ans_oz'] = sigFig($mass_oz,4).' oz';
                $this->param['ans_lb'] = sigFig($mass_lb,4).' lb';
                $this->param['ans_stone'] = sigFig($mass_stone,4).' stone';
                $this->param['ans_us_ton'] = sigFig($mass_us_ton,4).' US ton';
                $this->param['ans_long_ton'] = sigFig($mass_long_ton,4).' Long ton';
                $this->param['ans_u'] = sigFig($mass_u,4).' u';
            }elseif($cal==='mw' && is_numeric($mass) && is_numeric($moles)){
                $mw=$mass/$moles;
                $this->param['ans'] = sigFig($mw,4).' <span class="text-green font-s-25">g/mol</span>';
            }elseif($cal==='moles' && is_numeric($mass) && is_numeric($mw)){
                $moles=$mass/$mw;
                $moles_pm=$moles/0.000000000001;
                $moles_nm=$moles/0.000000001;
                $moles_um=$moles/0.000001;
                $moles_mm=$moles/0.001;
                $this->param['ans'] = sigFig($moles,4).' <span class="text-green font-s-25">M</span>';
                $this->param['ans_mm'] = sigFig($moles_mm,4).' mM';
                $this->param['ans_pm'] = sigFig($moles_pm,4).' pM';
                $this->param['ans_nm'] = sigFig($moles_nm,4).' nM';
                $this->param['ans_um'] = sigFig($moles_um,4).' μM';
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
            $molecules_23=sigFig(($moles*6.02214076),4);
            $molecules_22=sigFig(($molecules_23*10),4);
            $molecules_24=sigFig(($molecules_23*0.1),4);
            $this->param['molecules_22'] = $molecules_22.'x10²²';
            $this->param['molecules_23'] = $molecules_23.'x10²³';
            $this->param['molecules_24'] = $molecules_24.'x10²⁴';
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Atomic Mass Calculator
    public function atomic($request){
        $z=$request->z;
        $n=$request->n;
        if(is_numeric($z) && is_numeric($n)){
            function checkIsotope($isotopeList, $z, $n){
                for($i = 0; $i < count($isotopeList); $i++){
                    if($isotopeList[$i][0] == $z && $isotopeList[$i][1] == $n){
                        return true;
                    }
                }
                return false;
            }
            $elementSymbols = [
                "H", "He", "Li", "Be", "B", "C", "N", "O", "F", "Ne", "Na", "Mg", "Al", "Si", "P", "S",
                "Cl", "Ar", "K", "Ca", "Sc", "Ti", "V", "Cr", "Mn", "Fe", "Co", "Ni", "Cu", "Zn", "Ga",
                "Ge", "As", "Se", "Br", "Kr", "Rb", "Sr", "Y", "Zr", "Nb", "Mo", "Tc", "Ru", "Rh", "Pd",
                "Ag", "Cd", "In", "Sn", "Sb", "Te", "I", "Xe", "Cs", "Ba", "La", "Ce", "Pr", "Nd", "Pm",
                "Sm", "Eu", "Gd", "Tb", "Dy", "Ho", "Er", "Tm", "Yb", "Lu", "Hf", "Ta", "W", "Re", "Os",
                "Ir", "Pt", "Au", "Hg", "Tl", "Pb", "Bi", "Po", "At", "Rn", "Fr", "Ra", "Ac", "Th", "Pa",
                "U", "Np", "Pu", "Am", "Cm", "Bk", "Cf", "Es", "Fm", "Md", "No", "Lr", "Rf", "Db", "Sg",
                "Bh", "Hs", "Mt", "Ds", "Rg", "Cn", "Nh", "Fl", "Mc", "Lv", "Ts", "Og"
            ];
            $stableIsotopes = [
                [26,30],
                [28,34],
                [28,32],
                [26,32],
                [24,28],
                [26,31],
                [27,32],
                [24,30],
                [28,33],
                [25,30],
                [28,36],
                [30,36],
                [24,29],
                [29,34],
                [29,36],
                [30,38],
                [22,28],
                [23,28],
                [30,37],
                [22,26],
                [32,40],
                [32,38],
                [31,38],
                [38,50],
                [32,42],
                [22,27],
                [34,42],
                [31,40],
                [34,44],
                [40,50],
                [39,50],
                [38,48],
                [36,46],
                [36,48],
                [32,41],
                [38,49],
                [33,42],
                [36,44],
                [34,43],
                [37,48],
                [40,51],
                [36,47],
                [35,44],
                [35,46],
                [40,52],
                [22,24],
                [22,25],
                [20,24],
                [20,22],
                [18,20],
                [21,24],
                [20,23],
                [16,18],
                [18,22],
                [19,22],
                [19,20],
                [17,20],
                [16,20],
                [17,18],
                [14,16],
                [16,16],
                [16,17],
                [15,16],
                [14,14],
                [14,15],
                [13,14],
                [12,14],
                [12,12],
                [12,13],
                [11,12],
                [10,12],
                [10,10],
                [8,8],
                [10,11],
                [9,10],
                [8,9],
                [8,10],
                [6,6],
                [7,8],
                [7,7],
                [6,7],
                [2,2],
                [5,6],
                [5,5],
                [4,5],
                [3,4],
                [3,3],
                [2,1],
                [1,1],
                [1,0],
                [42,52],
                [41,52],
                [42,54],
                [42,53],
                [42,55],
                [44,54],
                [44,56],
                [44,55],
                [44,58],
                [44,57],
                [46,58],
                [45,58],
                [46,60],
                [46,59],
                [46,62],
                [47,60],
                [48,62],
                [47,62],
                [48,64],
                [48,63],
                [50,64],
                [49,64],
                [50,66],
                [50,65],
                [50,68],
                [50,67],
                [50,70],
                [50,69],
                [51,70],
                [52,70],
                [52,72],
                [51,72],
                [52,74],
                [52,73],
                [54,74],
                [53,74],
                [54,76],
                [54,75],
                [54,78],
                [54,77],
                [56,78],
                [55,78],
                [56,80],
                [56,79],
                [56,81],
                [56,82],
                [58,82],
                [57,82],
                [59,82],
                [60,82],
                [64,92],
                [64,93],
                [64,94],
                [65,94],
                [66,97],
                [66,98],
                [34,40],
                [34,46],
                [36,50],
                [38,46],
                [46,56],
                [44,60],
                [18,18],
                [50,62],
                [50,72],
                [54,72],
                [60,83],
                [62,82],
                [60,86],
                [62,88],
                [62,90],
                [63,90],
                [64,90],
                [64,91],
                [66,92],
                [66,94],
                [66,95],
                [66,96],
                [68,96],
                [67,98],
                [68,98],
                [68,99],
                [68,100],
                [69,100],
                [70,100],
                [70,101],
                [70,102],
                [70,103],
                [70,104],
                [71,104],
                [72,104],
                [72,105],
                [72,106],
                [72,107],
                [72,108],
                [73,108],
                [75,110],
                [76,111],
                [76,112],
                [76,113],
                [76,114],
                [77,114],
                [78,116],
                [77,116],
                [78,117],
                [78,118],
                [79,118],
                [80,118],
                [80,119],
                [80,120],
                [80,121],
                [80,122],
                [81,122],
                [80,124],
                [81,124],
                [82,124],
                [82,125],
                [54,80],
                [26,28],
                [20,20],
                [56,76],
                [82,126],
                [28,30],
                [42,50],
                [64,96],
                [74,110],
                [74,112],
                [74,109],
                [74,108],
                [48,66],
                [60,88],
                [80,116],
                [62,92],
                [24,26],
                [48,60],
                [66,90],
                [46,64],
                [68,102],
                [58,84],
                [48,58],
                [70,106],
                [82,122],
                [40,54],
                [50,74],
                [52,71],
                [44,52],
                [60,85],
                [78,114],
                [30,34],
                [52,68],
                [30,40],
                [20,26],
                [62,87],
                [73,107],
                [78,120],
                [68,94],
                [70,98],
                [42,56],
                [58,80],
                [58,78],
                [76,108],
                [76,116]
            ];
            $radioactiveIsotopes = [
                [52,76],
                [54,70],
                [36,42],
                [54,82],
                [32,44],
                [56,74],
                [34,48],
                [48,68],
                [20,28],
                [83,126],
                [40,56],
                [52,78],
                [60,90],
                [42,58],
                [63,88],
                [74,106],
                [23,27],
                [48,65],
                [62,86],
                [60,84],
                [76,110],
                [72,102],
                [49,66],
                [64,88],
                [78,112],
                [62,85],
                [57,81],
                [37,50],
                [75,112],
                [71,105],
                [90,142],
                [92,146],
                [19,21],
                [92,143],
                [94,150],
                [62,84],
                [41,51],
                [92,144],
                [82,123],
                [53,76],
                [96,151],
                [72,110],
                [46,61],
                [43,54],
                [43,55],
                [25,28],
                [66,88],
                [26,34],
                [83,127],
                [55,80],
                [93,144],
                [64,86],
                [40,53],
                [4,6],
                [13,13],
                [94,148],
                [83,125],
                [96,152],
                [17,19],
                [34,45],
                [92,142],
                [50,76],
                [36,45],
                [43,56],
                [75,111],
                [92,141],
                [93,143],
                [20,21],
                [28,31],
                [90,140],
                [57,80],
                [82,120],
                [91,140],
                [94,145],
                [41,53],
                [96,149],
                [96,154],
                [95,148],
                [90,139],
                [94,146],
                [6,8],
                [96,150],
                [67,96],
                [42,51],
                [88,138],
                [97,150],
                [67,99],
                [98,153],
                [41,50],
                [80,114],
                [47,61],
                [95,146],
                [98,151],
                [97,151],
                [18,21],
                [77,115],
                [65,93],
                [95,147],
                [14,18],
                [84,125],
                [28,35],
                [62,89],
                [94,144],
                [65,92],
                [64,84],
                [92,140],
                [22,22],
                [78,115],
                [50,71],
                [63,87],
                [18,24],
                [83,124],
                [72,106],
                [55,82],
                [96,147],
                [38,52],
                [82,128],
                [89,138],
                [96,148],
                [61,84],
                [41,52],
                [94,147],
                [48,65],
                [63,89],
                [98,152],
                [1,2],
                [36,49],
                [56,77],
                [63,91],
                [76,118],
                [88,140],
                [61,85],
                [27,33],
                [63,92],
                [81,123],
                [71,103],
                [45,56],
                [45,57],
                [84,124],
                [94,142],
                [51,74],
                [26,29],
                [98,154],
                [61,86],
                [11,11],
                [55,79],
                [69,102],
                [90,138],
                [72,100],
                [73,106],
                [71,102],
                [99,153],
                [48,61],
                [93,142],
                [44,62],
                [61,83],
                [62,83],
                [98,150],
                [97,152],
                [23,26],
                [25,29],
                [50,69],
                [58,86],
                [99,155],
                [27,30],
                [32,36],
                [61,82],
                [47,63],
                [30,35],
                [64,89],
                [45,57],
                [79,116],
                [77,117],
                [75,109],
                [96,146],
                [20,25],
                [71,106],
                [52,69],
                [66,93],
                [71,103],
                [84,126],
                [58,81],
                [50,73],
                [69,101],
                [64,87],
                [74,107],
                [34,41],
                [52,71],
                [50,63],
                [73,109],
                [52,75],
                [39,49],
                [100,157],
                [76,109],
                [69,99],
                [63,86],
                [43,54],
                [16,19],
                [37,46],
                [21,25],
                [40,48],
                [33,40],
                [27,29],
                [74,111],
                [77,115],
                [65,95],
                [27,31],
                [75,108],
                [72,103],
                [74,114],
                [38,47],
                [40,55],
                [43,52],
                [41,50],
                [98,156],
                [51,73],
                [53,72],
                [39,52],
                [52,73],
                [63,85],
                [4,3],
                [101,157],
                [38,51],
                [49,65],
                [64,82],
                [80,123],
                [94,143],
                [48,67],
                [26,33],
                [72,109],
                [61,87],
                [47,58],
                [99,156],
                [44,59],
                [54,73],
                [75,109],
                [41,54],
                [18,19],
                [52,77],
                [37,47],
                [96,145],
                [58,83],
                [70,99],
                [101,159],
                [24,27],
                [96,144],
                [91,142],
                [38,44],
                [15,18],
                [72,107],
                [90,144],
                [63,84],
                [74,104],
                [92,138],
                [99,154],
                [52,69],
                [90,137],
                [37,49],
                [98,155],
                [33,41],
                [91,139],
                [46,57],
                [45,54],
                [23,25],
                [76,115],
                [83,122],
                [63,93],
                [88,137],
                [15,17],
                [50,67],
                [59,84],
                [77,112],
                [55,81],
                [53,73],
                [56,84],
                [51,75],
                [81,121],
                [54,77],
                [77,113],
                [56,75],
                [88,135],
                [32,39],
                [60,87],
                [94,152],
                [77,116],
                [78,110],
                [41,51],
                [89,136],
                [55,76],
                [50,75],
                [68,101],
                [64,85],
                [69,98],
                [54,75],
                [84,122],
                [34,38],
                [47,59],
                [71,100],
                [53,78],
                [99,158],
                [47,64],
                [65,96],
                [92,145],
                [71,101],
                [71,106],
                [55,77],
                [83,123],
                [79,117],
                [28,28],
                [52,66],
                [63,82],
                [51,69],
                [25,27],
                [61,87],
                [65,91],
                [65,90],
                [54,79],
                [73,110],
                [83,127],
                [97,148],
                [52,67],
                [63,83],
                [20,27],
                [93,141],
                [45,56],
                [78,115],
                [43,53],
                [92,139],
                [70,105],
                [53,71],
                [78,117],
                [51,76],
                [86,136],
                [75,111],
                [88,136],
                [46,54],
                [41,54],
                [66,100],
                [60,80],
                [21,26],
                [39,48],
                [40,49],
                [31,36],
                [52,80],
                [58,76],
                [79,120],
                [81,120],
                [100,153],
                [78,113],
                [49,62],
                [44,53],
                [42,57],
                [51,71],
                [33,38],
                [79,119],
                [80,117],
                [39,51],
                [75,107],
                [69,103],
                [29,38],
                [21,23],
                [56,72],
                [35,42],
                [70,96],
                [73,104],
                [93,146],
                [65,88],
                [28,38],
                [94,153],
                [79,119],
                [48,67],
                [61,88],
                [54,79],
                [82,121],
                [93,145],
                [95,145],
                [68,104],
                [71,99],
                [30,42],
                [62,91],
                [78,124],
                [21,27],
                [97,149],
                [80,115],
                [77,111],
                [57,83],
                [99,155],
                [32,37],
                [56,77],
                [33,44],
                [51,68],
                [64,83],
                [79,115],
                [91,138],
                [98,148],
                [28,29],
                [45,60],
                [35,47],
                [36,43],
                [58,79],
                [71,98],
                [58,85],
                [99,152],
                [38,45],
                [55,74],
                [105,163],
                [91,141],
                [76,117],
                [69,96],
                [52,79],
                [89,137],
                [68,92],
                [61,90],
                [56,79],
                [50,71],
                [67,99],
                [33,43],
                [81,119],
                [33,39],
                [90,141],
                [100,152],
                [96,156],
                [65,91],
                [75,114],
                [80,117],
                [74,113],
                [97,151],
                [72,101],
                [41,55],
                [65,89],
                [93,143],
                [19,24],
                [76,106],
                [91,137],
                [24,24],
                [65,89],
                [82,118],
                [46,66],
                [12,16],
                [45,55],
                [53,80],
                [54,68],
                [100,155],
                [43,52],
                [75,106],
                [78,119],
                [57,78],
                [77,117],
                [59,83],
                [79,121],
                [64,95],
                [58,77],
                [79,114],
                [65,86],
                [27,28],
                [65,87],
                [75,113],
                [54,71],
                [40,57],
                [77,109],
                [40,46],
                [35,41],
                [52,67],
                [95,147],
                [72,98],
                [63,94],
                [11,13],
                [36,40],
                [39,47],
                [86,125],
                [41,49],
                [77,108],
                [92,148],
                [31,41],
                [30,39],
                [46,63],
                [39,48],
                [53,70],
                [76,115],
                [76,107],
                [63,87],
                [29,35],
                [75,107],
                [78,122],
                [53,77],
                [19,23],
                [72,99],
                [95,144],
                [80,113],
                [83,120],
                [32,45],
                [83,121],
                [78,111],
                [82,130],
                [80,115],
                [73,102],
                [94,151],
                [77,110],
                [68,97],
                [39,54],
                [95,149],
                [103,163],
                [65,89],
                [76,107],
                [66,89],
                [38,53],
                [79,117],
                [31,35],
                [62,94],
                [52,75],
                [82,119],
                [63,89],
                [30,32],
                [54,81],
                [27,31],
                [51,77],
                [58,79],
                [94,140],
                [73,111],
                [99,151],
                [46,55],
                [26,26],
                [69,104],
                [73,107],
                [66,91],
                [85,125],
                [73,103],
                [69,97],
                [99,157],
                [68,103],
                [81,118],
                [85,126],
                [34,39],
                [42,51],
                [91,143],
                [53,82],
                [48,59],
                [37,45],
                [66,87],
                [55,72],
                [89,139],
                [43,56],
                [59,86],
                [76,113],
                [84,123],
                [42,48],
                [101,156],
                [46,65],
                [60,79],
                [72,108],
                [85,124],
                [47,66],
                [65,91],
                [81,117],
                [100,151],
                [60,78],
                [67,93],
                [51,67],
                [94,149],
                [79,113],
                [49,61],
                [58,75],
                [43,51],
                [39,46],
                [31,42],
                [80,112],
                [57,75],
                [45,54],
                [105,162],
                [71,108],
                [37,44],
                [97,146],
                [49,66],
                [36,49],
                [44,61],
                [35,45],
                [59,80],
                [51,78],
                [97,147],
                [49,60],
                [72,112],
                [65,84],
                [50,60],
                [21,23],
                [30,41],
                [57,84],
                [57,76],
                [21,22],
                [77,118],
                [80,113],
                [71,105],
                [103,159],
                [82,120],
                [39,53],
                [84,120],
                [58,74],
                [65,85],
                [48,69],
                [29,32],
                [82,127],
                [100,154],
                [97,153],
                [68,93],
                [75,115],
                [39,51],
                [79,112],
                [73,100],
                [47,65],
                [98,149],
                [77,107],
                [77,113],
                [22,23],
                [67,100],
                [62,72],
                [96,143],
                [81,116],
                [36,52],
                [16,22],
                [38,49],
                [51,66],
                [89,135],
                [43,50],
                [39,46],
                [61,89],
                [38,54],
                [100,156],
                [14,17],
                [25,31],
                [28,37],
                [77,118],
                [74,102],
                [48,69],
                [52,64],
                [60,81],
                [67,94],
                [86,124],
                [82,116],
                [96,142],
                [35,48],
                [66,86],
                [73,105],
                [78,109],
                [66,99],
                [104,163],
                [53,79],
                [68,90],
                [32,34],
                [56,73],
                [62,88],
                [74,103],
                [45,61],
                [56,73],
                [59,79],
                [53,68],
                [50,77],
                [54,69],
                [78,108],
                [95,150],
                [41,48],
                [76,119],
                [49,68],
                [77,109],
                [70,107],
                [81,117],
                [81,115],
                [36,47],
                [9,9],
                [18,23],
                [69,94],
                [91,148],
                [83,118],
                [85,122],
                [86,138],
                [38,42],
                [76,105],
                [84,121],
                [60,89],
                [83,119],
                [99,150],
                [65,82],
                [40,47],
                [56,70],
                [49,64],
                [27,34],
                [44,51],
                [95,143],
                [85,123],
                [58,75],
                [35,40],
                [63,89],
                [101,158],
                [78,119],
                [88,142],
                [57,85],
                [33,45],
                [82,117],
                [32,46],
                [98,157],
                [81,115],
                [77,119],
                [53,79],
                [56,83],
                [32,43],
                [53,67],
                [105,161],
                [101,155],
                [59,78],
                [36,51],
                [70,94],
                [68,95],
                [36,41],
                [70,108],
                [95,142],
                [62,80],
                [41,56],
                [78,107],
                [81,114],
                [52,77],
                [47,57],
                [49,61],
                [73,101],
                [31,37],
                [38,47],
                [77,113],
                [67,95],
                [82,122],
                [41,48],
                [47,56],
                [96,153],
                [72,111],
                [89,140],
                [52,65],
                [93,147],
                [72,110],
                [83,129],
                [51,65],
                [65,83],
                [105,165]
            ];
            $a = $z + $n;
            if($z > 118){
                $this->param['error'] = 'To date, the maximum number of protons is 118.';
                return $this->param;
            }elseif($n > 177){
                $this->param['error'] = 'To date, the maximum number of neutrons is 177.';
                return $this->param;
            }else{
                if($a > 0 && $z > 0 && $n >= 0){
                    $this->param['symbol']=$elementSymbols[$z - 1];
                    if(checkIsotope($stableIsotopes, $z, $n)){
                        $this->param['stable']='Stable';
                    }elseif(checkIsotope($radioactiveIsotopes, $z, $n)){
                        $this->param['unstable']='Unstable,';
                    }else{
                        $this->param['unobserved']='Unobserved';
                    }
                }
            }
            $this->param['a']=$a;
            $this->param['asi']=$a*1.66;
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Nernst Equation Calculator
    public function nernst($request){
        $cal=trim($request->cal);
        $ecell=trim($request->ecell);
        $ecell_unit=trim($request->ecell_unit);
        $eo=trim($request->eo);
        $eo_unit=trim($request->eo_unit);
        $t=trim($request->t);
        $t_unit=trim($request->t_unit);
        $n=trim($request->n);
        $q=trim($request->q);

        if(is_numeric($ecell) && is_numeric($eo) && is_numeric($t) && is_numeric($n) && is_numeric($q)){
            if(is_numeric($ecell)){
                if($ecell_unit==='mV'){
                    $ecell=$ecell*0.001;
                }
            }
            if(is_numeric($eo)){
                if($eo_unit==='mV'){
                    $eo=$eo*0.001;
                }
            }
            if(is_numeric($t)){
                if($t_unit==='°C'){
                    $t=$t*274.15;
                }elseif($t_unit==='°F'){
                    $t=$t*255.93;
                }
            }
            $r=0.00008617332;
			// dd($eo-$ecell);
			if ($cal === 'ecell' && is_numeric($eo) && is_numeric($t) && is_numeric($n) && is_numeric($q)) {
				$ecell = $eo - ($r * $t) * (log($q)) / $n;
				$this->param['ans'] = $ecell . ' <span class="text-green font-s-25">V</span>';
			} elseif ($cal === 'eo' && is_numeric($ecell) && is_numeric($t) && is_numeric($n) && is_numeric($q)) {
				$eo = $ecell + (($r * $t) * log($q) / $n);
				$this->param['ans'] = $eo . ' <span class="text-green font-s-25">V</span>';
			} elseif ($cal === 't' && is_numeric($ecell) && is_numeric($eo) && is_numeric($n) && is_numeric($q)) {
				$denominator = log($q) * $r;
				if ($denominator == 0) {
					$t = INF; // Handle division by zero by setting result to INF
				} else {
					$t = ($eo - $ecell) * $n / $denominator;
				}
				$this->param['ans'] = $t . ' <span class="text-green font-s-25">K</span>';
			} elseif ($cal === 'n' && is_numeric($ecell) && is_numeric($eo) && is_numeric($t) && is_numeric($q)) {
				if (($eo - $ecell) == 0) {
					$n = INF; // Handle division by zero by setting result to INF
				} else {
					$n = (log($q) * $r * $t) / ($eo - $ecell);
				}
				$this->param['ans'] = $n;
			} elseif ($cal === 'q' && is_numeric($ecell) && is_numeric($eo) && is_numeric($t) && is_numeric($n)) {
				if (($r * $t) == 0) {
					$q = INF; // Handle division by zero by setting result to INF
				} else {
					$q = exp($n * ($eo - $ecell) / ($r * $t));
				}
				$this->param['ans'] = $q;
			} else {
				$this->param['error'] = 'Please! Check Your Input.';
				return $this->param;
			}
			
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Partial Pressure Calculator
    public function partial($request){
        $formula=$request->formula;
        $to_cal1=$request->to_cal1;
        $total=$request->total;
        $total_unit=$request->total_unit;
        $mole=$request->mole;
        $partial=$request->partial;
        $part_unit=$request->part_unit;
        $to_cal2=$request->to_cal2;
        $amole=$request->amole;
        $temp=$request->temp;
        $temp_unit=$request->temp_unit;
        $volume=$request->volume;
        $vol_unit=$request->vol_unit;
        $partial1=$request->partial1;
        $part_unit1=$request->part_unit1;
        $to_cal3=$request->to_cal3;
        $gas=$request->gas;
        $cons=$request->cons;
        $conc=$request->conc;
        $conc_unit=$request->conc_unit;
        $partial2=$request->partial2;
        $part_unit2=$request->part_unit2;
        $to_cal4=$request->to_cal4;
        $gas1=$request->gas1;
        $mole1=$request->mole1;
        $partial3=$request->partial3;
        $cons1=$request->cons1;
        $cons1_unit2=$request->cons1_unit2;
        $part_unit3=$request->part_unit3;

        if ($formula==='1') {
            if ($to_cal1==='1') {
                if (is_numeric($total) && is_numeric($mole)) {
                    if ($mole>1) {
                        $this->param['error'] = "Mole fraction value can't be greater than 1.";
                        return $this->param;
                    }else{
                        $ans=$total*$mole;
                        $this->param['mode'] = 1;
                        $this->param['ans'] = $ans;
                        $this->param['unit'] = $total_unit;
                        $this->param['RESULT'] = 1;
                        return $this->param;
                    }
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }elseif ($to_cal1==='2') {
                if (is_numeric($total) && is_numeric($partial)) {
                    if ($part_unit!=$total_unit) {
                        if ($part_unit==='Bar') {
                            $partial=$partial*100000;
                        }elseif ($part_unit==='Torr') {
                            $partial=$partial*133.32;
                        }elseif ($part_unit==='psi') {
                            $partial=$partial*6895;
                        }elseif ($part_unit==='atm') {
                            $partial=$partial*101325;
                        }elseif ($part_unit==='hPa') {
                            $partial=$partial*100;
                        }elseif ($part_unit==='MPa') {
                            $partial=$partial*1000000;
                        }elseif ($part_unit==='kPa') {
                            $partial=$partial*1000;
                        }elseif ($part_unit==='GPa') {
                            $partial=$partial*1000000000;
                        }elseif ($part_unit==='mmHg') {
                            $partial=$partial*133.32;
                        }elseif ($part_unit==='in Hg') {
                            $partial=$partial*3386.4;
                        }
                        if ($total_unit==='Bar') {
                            $total=$total*100000;
                        }elseif ($total_unit==='Torr') {
                            $total=$total*133.32;
                        }elseif ($total_unit==='psi') {
                            $total=$total*6895;
                        }elseif ($total_unit==='atm') {
                            $total=$total*101325;
                        }elseif ($total_unit==='hPa') {
                            $total=$total*100;
                        }elseif ($total_unit==='MPa') {
                            $total=$total*1000000;
                        }elseif ($total_unit==='kPa') {
                            $total=$total*1000;
                        }elseif ($total_unit==='GPa') {
                            $total=$total*1000000000;
                        }elseif ($total_unit==='mmHg') {
                            $total=$total*133.32;
                        }elseif ($total_unit==='in Hg') {
                            $total=$total*3386.4;
                        }
                    }
                    $ans=$partial/$total;
                    $this->param['mode'] = 2;
                    $this->param['ans'] = $ans;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }elseif ($to_cal1==='3') {
                if (is_numeric($partial) && is_numeric($mole)) {
                    if ($mole>1) {
                        $this->param['error'] = "Mole fraction value can't be greater than 1.";
                        return $this->param;
                    }else{
                        $ans=$partial/$mole;
                        $this->param['mode'] = 3;
                        $this->param['ans'] = $ans;
                        $this->param['unit'] = $part_unit;
                        $this->param['RESULT'] = 1;
                        return $this->param;
                    }
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
        }elseif ($formula==='2') {
            if ($to_cal2==='1') {
                if (is_numeric($amole) && is_numeric($temp) && is_numeric($volume)) {
                    if ($vol_unit==='cm³') {
                        $volume=$volume / 1e+6;
                    }elseif ($vol_unit==='mm³') {
                        $volume=$volume / 1e+9;
                    }elseif ($vol_unit==='dm³') {
                        $volume=$volume / 1000;
                    }elseif ($vol_unit==='ft³') {
                        $volume=$volume / 35.315;
                    }elseif ($vol_unit==='yd³') {
                        $volume=$volume *0.7646;
                    }elseif ($vol_unit==='in³') {
                        $volume=$volume / 61024;
                    }elseif ($vol_unit==='litre') {
                        $volume=$volume * 0.001;
                    }
                    if ($temp_unit==='°C') {
                        $temp=$temp + 273.15;
                    }
                    if ($temp_unit==='°F') {
                        $temp=($temp - 32) * 5/9 + 273.15;
                    }
                    $ans=($amole*8.3145*$temp)/$volume;
                    $this->param['mode'] = 4;
                    $this->param['ans'] = $ans;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }elseif ($to_cal2==='2') {
                if (is_numeric($amole) && is_numeric($temp) && is_numeric($partial1)) {
                    if ($part_unit1==='Bar') {
                        $partial1=$partial1*100000;
                    }elseif ($part_unit1==='Torr') {
                        $partial1=$partial1*133.32;
                    }elseif ($part_unit1==='psi') {
                        $partial1=$partial1*6895;
                    }elseif ($part_unit1==='atm') {
                        $partial1=$partial1*101325;
                    }elseif ($part_unit1==='hPa') {
                        $partial1=$partial1*100;
                    }elseif ($part_unit1==='MPa') {
                        $partial1=$partial1*1000000;
                    }elseif ($part_unit1==='kPa') {
                        $partial1=$partial1*1000;
                    }elseif ($part_unit1==='GPa') {
                        $partial1=$partial1*1000000000;
                    }elseif ($part_unit1==='mmHg') {
                        $partial1=$partial1*133.32;
                    }elseif ($part_unit1==='in Hg') {
                        $partial1=$partial1*3386.4;
                    }
                    if ($temp_unit==='°C') {
                        $temp=$temp + 273.15;
                    }
                    if ($temp_unit==='°F') {
                        $temp=($temp - 32) * 5/9 + 273.15;
                    }
                    $ans=($amole*8.3145*$temp)/$partial1;
                    $this->param['mode'] = 5;
                    $this->param['ans'] = $ans;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }elseif ($to_cal2==='3') {
                if (is_numeric($amole) && is_numeric($volume) && is_numeric($partial1)) {
                    if ($part_unit1==='Bar') {
                        $partial1=$partial1*100000;
                    }elseif ($part_unit1==='Torr') {
                        $partial1=$partial1*133.32;
                    }elseif ($part_unit1==='psi') {
                        $partial1=$partial1*6895;
                    }elseif ($part_unit1==='atm') {
                        $partial1=$partial1*101325;
                    }elseif ($part_unit1==='hPa') {
                        $partial1=$partial1*100;
                    }elseif ($part_unit1==='MPa') {
                        $partial1=$partial1*1000000;
                    }elseif ($part_unit1==='kPa') {
                        $partial1=$partial1*1000;
                    }elseif ($part_unit1==='GPa') {
                        $partial1=$partial1*1000000000;
                    }elseif ($part_unit1==='mmHg') {
                        $partial1=$partial1*133.32;
                    }elseif ($part_unit1==='in Hg') {
                        $partial1=$partial1*3386.4;
                    }
                    if ($vol_unit==='cm³') {
                        $volume=$volume / 1e+6;
                    }elseif ($vol_unit==='mm³') {
                        $volume=$volume / 1e+9;
                    }elseif ($vol_unit==='dm³') {
                        $volume=$volume / 1000;
                    }elseif ($vol_unit==='ft³') {
                        $volume=$volume / 35.315;
                    }elseif ($vol_unit==='yd³') {
                        $volume=$volume *0.7646;
                    }elseif ($vol_unit==='in³') {
                        $volume=$volume / 61024;
                    }elseif ($vol_unit==='litre') {
                        $volume=$volume * 0.001;
                    }
                    $ans=($volume*$partial1)/($amole*8.3145);
                    $this->param['mode'] = 6;
                    $this->param['ans'] = $ans;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }elseif ($to_cal2==='4') {
                if (is_numeric($temp) && is_numeric($volume) && is_numeric($partial1)) {
                    if ($part_unit1==='Bar') {
                        $partial1=$partial1*100000;
                    }elseif ($part_unit1==='Torr') {
                        $partial1=$partial1*133.32;
                    }elseif ($part_unit1==='psi') {
                        $partial1=$partial1*6895;
                    }elseif ($part_unit1==='atm') {
                        $partial1=$partial1*101325;
                    }elseif ($part_unit1==='hPa') {
                        $partial1=$partial1*100;
                    }elseif ($part_unit1==='MPa') {
                        $partial1=$partial1*1000000;
                    }elseif ($part_unit1==='kPa') {
                        $partial1=$partial1*1000;
                    }elseif ($part_unit1==='GPa') {
                        $partial1=$partial1*1000000000;
                    }elseif ($part_unit1==='mmHg') {
                        $partial1=$partial1*133.32;
                    }elseif ($part_unit1==='in Hg') {
                        $partial1=$partial1*3386.4;
                    }
                    if ($vol_unit==='cm³') {
                        $volume=$volume / 1e+6;
                    }elseif ($vol_unit==='mm³') {
                        $volume=$volume / 1e+9;
                    }elseif ($vol_unit==='dm³') {
                        $volume=$volume / 1000;
                    }elseif ($vol_unit==='ft³') {
                        $volume=$volume / 35.315;
                    }elseif ($vol_unit==='yd³') {
                        $volume=$volume *0.7646;
                    }elseif ($vol_unit==='in³') {
                        $volume=$volume / 61024;
                    }elseif ($vol_unit==='litre') {
                        $volume=$volume * 0.001;
                    }
                    if ($temp_unit==='°C') {
                        $temp=$temp + 273.15;
                    }
                    if ($temp_unit==='°F') {
                        $temp=($temp - 32) * 5/9 + 273.15;
                    }
                    $ans=($volume*$partial1)/($temp*8.3145);
                    $this->param['mode'] = 7;
                    $this->param['ans'] = $ans;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
        }elseif ($formula==='3') {
            if ($gas==='1') {
                $gas=77942230;
            }elseif ($gas==='2') {
                $gas=129903716;
            }elseif ($gas==='3') {
                $gas=2979968;
            }elseif ($gas==='4') {
                $gas=166106126;
            }elseif ($gas==='5') {
                $gas=273851078;
            }elseif ($gas==='6') {
                $gas=225166442;
            }elseif ($gas==='7') {
                $gas=72374421;
            }elseif ($gas==='8') {
                $gas=106657735;
            }elseif ($gas==='9') {
                if (!is_numeric($cons)) {
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }else{
                    $gas=101325*$cons;
                }
            }
            if ($to_cal3==='1') {
                if (is_numeric($gas) && is_numeric($conc)) {
                    if ($conc_unit==='mM') {
                        $conc=$conc*1000;
                    }elseif ($conc_unit==='μM') {
                        $conc=$conc*1000000;
                    }elseif ($conc_unit==='nM') {
                        $conc=$conc*1000000000;
                    }elseif ($conc_unit==='pM') {
                        $conc=$conc*1000000000000;
                    }elseif ($conc_unit==='fM') {
                        $conc=$conc*1000000000000000;
                    }elseif ($conc_unit==='aM') {
                        $conc=$conc*1000000000000000000;
                    }elseif ($conc_unit==='zM') {
                        $conc=$conc*1000000000000000000000;
                    }elseif ($conc_unit==='yM') {
                        $conc=$conc*1000000000000000000000000;
                    }
                    $ans=$gas*$conc;
                    $this->param['mode'] = 4;
                    $this->param['ans'] = $ans;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }elseif ($to_cal3==='2') {
                if (is_numeric($gas) && is_numeric($partial2)) {
                    if ($part_unit2==='Bar') {
                        $partial2=$partial2*100000;
                    }elseif ($part_unit2==='Torr') {
                        $partial2=$partial2*133.32;
                    }elseif ($part_unit2==='psi') {
                        $partial2=$partial2*6895;
                    }elseif ($part_unit2==='atm') {
                        $partial2=$partial2*101325;
                    }elseif ($part_unit2==='hPa') {
                        $partial2=$partial2*100;
                    }elseif ($part_unit2==='MPa') {
                        $partial2=$partial2*1000000;
                    }elseif ($part_unit2==='kPa') {
                        $partial2=$partial2*1000;
                    }elseif ($part_unit2==='GPa') {
                        $partial2=$partial2*1000000000;
                    }elseif ($part_unit2==='mmHg') {
                        $partial2=$partial2*133.32;
                    }elseif ($part_unit2==='in Hg') {
                        $partial2=$partial2*3386.4;
                    }
                    $ans=$partial2/$gas;
                    $this->param['mode'] = 8;
                    $this->param['ans'] = $ans;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
        }elseif ($formula==='4') {
            if ($gas1==='1') {
                $gas1=4315431750;
            }elseif ($gas1==='2') {
                $gas1=7193061750;
            }elseif ($gas1==='3') {
                $gas1=165159750;
            }elseif ($gas1==='4') {
                $gas1=9197270250;
            }elseif ($gas1==='5') {
                $gas1=15168352500;
            }elseif ($gas1==='6') {
                $gas1=12462975000;
            }elseif ($gas1==='7') {
                $gas1=4007403750;
            }elseif ($gas1==='8') {
                $gas1=5905221000;
            }elseif ($gas1==='9') {
                if (!is_numeric($cons1)) {
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }else{
                    if ($cons1_unit2==='Bar') {
                        $cons1=$cons1*100000;
                    }elseif ($cons1_unit2==='Torr') {
                        $cons1=$cons1*133.32;
                    }elseif ($cons1_unit2==='psi') {
                        $cons1=$cons1*6895;
                    }elseif ($cons1_unit2==='atm') {
                        $cons1=$cons1*101325;
                    }elseif ($cons1_unit2==='hPa') {
                        $cons1=$cons1*100;
                    }elseif ($cons1_unit2==='MPa') {
                        $cons1=$cons1*1000000;
                    }elseif ($cons1_unit2==='kPa') {
                        $cons1=$cons1*1000;
                    }elseif ($cons1_unit2==='GPa') {
                        $cons1=$cons1*1000000000;
                    }elseif ($cons1_unit2==='mmHg') {
                        $cons1=$cons1*133.32;
                    }elseif ($cons1_unit2==='in Hg') {
                        $cons1=$cons1*3386.4;
                    }
                    $gas1=$cons1;
                }
            }
            if ($to_cal4==='1') {
                if (is_numeric($mole1) && is_numeric($gas1)) {
                    if ($mole1>1) {
                        $this->param['error'] = "Mole fraction value can't be greater than 1.";
                        return $this->param;
                    }else{
                        $ans=$mole1*$gas1;
                        $this->param['mode'] = 4;
                      $this->param['ans'] = $ans;
                      $this->param['RESULT'] = 1;
                      return $this->param;
                    }
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }elseif ($to_cal4==='2') {
                if (is_numeric($partial3) && is_numeric($gas1)) {
                    if ($part_unit3==='Bar') {
                        $partial3=$partial3*100000;
                    }elseif ($part_unit3==='Torr') {
                        $partial3=$partial3*133.32;
                    }elseif ($part_unit3==='psi') {
                        $partial3=$partial3*6895;
                    }elseif ($part_unit3==='atm') {
                        $partial3=$partial3*101325;
                    }elseif ($part_unit3==='hPa') {
                        $partial3=$partial3*100;
                    }elseif ($part_unit3==='MPa') {
                        $partial3=$partial3*1000000;
                    }elseif ($part_unit3==='kPa') {
                        $partial3=$partial3*1000;
                    }elseif ($part_unit3==='GPa') {
                        $partial3=$partial3*1000000000;
                    }elseif ($part_unit3==='mmHg') {
                        $partial3=$partial3*133.32;
                    }elseif ($part_unit3==='in Hg') {
                        $partial3=$partial3*3386.4;
                    }
                    $ans=$partial3/$gas1;
                    $this->param['mode'] = 2;
                    $this->param['ans'] = $ans;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
        }
    }

    // Molecular Formula Calculator
  	public function molecular($request){
        $no1=trim($request->no1);
        $opt1=trim($request->opt1);
        $no2=trim($request->no2);
        $opt2=trim($request->opt2);

	

      if(is_numeric($no1) && is_numeric($no2)){
          $separate_element1=explode("@@",$opt1);
          $nbr1=$separate_element1[0];
          $name=$separate_element1[1];

          $separate_element2=explode("@@",$opt2);
          $nbr2=$separate_element2[0];
          $name2=$separate_element2[1];

          $final_result1=($no1/$nbr1);
          $final_result2=($no2/$nbr2);
          $final_result3=($final_result1/$final_result2);

          $this->param['mode'] = 2;
          $this->param['name'] = $name;
          $this->param['name2'] = $name2;
          $this->param['nbr1'] = $nbr1;
          $this->param['nbr2'] = $nbr2;
          $this->param['no1'] = $no1;
          $this->param['no2'] = $no2;
          $this->param['final_result1'] = $final_result1;
          $this->param['final_result2'] = $final_result2;
          $this->param['final_result3'] = $final_result3;
          $this->param['RESULT'] = 1;

          return $this->param;
        }else{
          $this->param['error'] = 'Please! Check Your Input.';
          return $this->param;
      }
    }

    // Formal Charge Calculator
  	public function formal($request){
        $V=trim($request->V);
        $LP=trim($request->LP);
        $BE=trim($request->BE);

        if (is_numeric($V) && is_numeric($LP) && is_numeric($BE)) {
            $formal=$V - ($LP + (0.5 * $BE));
            $this->param['formal'] = $formal;
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
          $this->param['error'] = 'Please! Check Your Input.';
          return $this->param;
        }
    }

    // Grams to Moles Calculator
  	public function grams($request){
        $chemical_selection=$request->chemical_selection;
        $unit=$request->unit;
        $mm_unit=$request->mm_unit;
        $mm=$request->mm;
        $m_unit=$request->m_unit;
        $m=$request->m;
        $nm=$request->nm;
        $nm_unit=$request->nm_unit;

		
		if($nm_unit == 'mol'){
			$nm_unit = '1';
		}else if($nm_unit == 'mmol'){
			$nm_unit = '2';
		}else if($nm_unit == 'μmol'){
			$nm_unit = '3';
		}else if($nm_unit == 'nmol'){
			$nm_unit = '4';
		}else if($nm_unit == 'pmol'){
			$nm_unit = '5';
		}
		
		if($m_unit == 'ng'){
			$m_unit = '1';
		}else if($m_unit == 'µg'){
			$m_unit = '2';
		}else if($m_unit == 'mg'){
			$m_unit = '3';
		}else if($m_unit == 'g'){
			$m_unit = '4';
		}else if($m_unit == 'dag'){
			$m_unit = '5';
		}else if($m_unit == 'kg'){
			$m_unit = '6';

		}

		if($mm_unit == 'g/mol'){
			$mm_unit = '1';
		}else if($mm_unit == 'dag/mol'){
			$mm_unit = '2';

		}else if($mm_unit == 'kg/mol'){
			$mm_unit = '3';
		}



        if($unit=="1"){
            if(is_numeric($mm) && is_numeric($m) && $mm>0 && $m>0){
                if ($mm_unit=="1"){
                    $mm_convert=$mm*1;
                }elseif ($mm_unit=="2"){
                    $mm_convert=$mm*10;
                }elseif ($mm_unit=="3"){
                    $mm_convert=$mm*1000;
                }
                if ($m_unit=="1") {
                    $m_convert=$m*0.000000001;
                }elseif ($m_unit=="2") {
                    $m_convert=$m*0.000001;
                }elseif ($m_unit=="3") {
                    $m_convert=$m*0.001;
                }elseif ($m_unit=="4") {
                    $m_convert=$m*1;
                }elseif ($m_unit=="5") {
                    $m_convert=$m*10;
                }elseif ($m_unit=="6") {
                    $m_convert=$m*1000;
                }
                $ans1=$m_convert/$mm_convert;
                $ans2=$ans1*6.02214085774;
                $this->param['ans90']=$m_convert;
                $this->param['ans91']=$mm_convert;
                $this->param['ans1'] = $ans1;
                $this->param['ans2'] = $ans2;
                $this->param['RESULT'] = 1;

                return $this->param;
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }if($unit=="2"){
            if(is_numeric($mm) && is_numeric($nm) && $m>0 && $nm>0){
                if ($mm_unit=="1"){
                    $mm_convert=$mm*1;
                }elseif ($mm_unit=="2"){
                    $mm_convert=$mm*10;
                }elseif ($mm_unit=="3"){
                    $mm_convert=$mm*1000;
                }
                if($nm_unit=="1"){
                    $nm_convert=$nm*1;
                }elseif ($nm_unit=="2") {
                    $nm_convert=$nm*0.001;
                }elseif ($nm_unit=="3") {
                    $nm_convert=$nm*0.000001;
                }elseif ($nm_unit=="4") {
                    $nm_convert=$nm*0.000000001;
                }elseif ($nm_unit=="5") {
                    $nm_convert=$nm*0.000000000001;
                }	
                $ans1=$nm_convert*$mm_convert;
                $ans2=$nm_convert*6.02214085774;
                $this->param['ans90']=$mm_convert;
                $this->param['ans91']=$nm_convert;
                $this->param['ans3'] = $ans1;
                $this->param['ans4'] = $ans2;
                $this->param['RESULT'] = 1;

                return $this->param;
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }if($unit=="3"){
            if(is_numeric($m) && is_numeric($nm) && $m>0 && $nm>0){
                if ($m_unit=="1") {
                    $m_convert=$m*0.000000001;
                }elseif ($m_unit=="2") {
                    $m_convert=$m*0.000001;
                }elseif ($m_unit=="3") {
                    $m_convert=$m*0.001;
                }elseif ($m_unit=="4") {
                    $m_convert=$m*1;
                }elseif ($m_unit=="5") {
                    $m_convert=$m*10;
                }elseif ($m_unit=="6") {
                    $m_convert=$m*1000;
                }
                if($nm_unit=="1"){
                    $nm_convert=$nm*1;
                }elseif ($nm_unit=="2") {
                    $nm_convert=$nm*0.001;
                }elseif ($nm_unit=="3") {
                    $nm_convert=$nm*0.000001;
                }elseif ($nm_unit=="4") {
                    $nm_convert=$nm*0.000000001;
                }elseif ($nm_unit=="5") {
                    $nm_convert=$nm*0.000000000001;
                }		
                $ans1=$m_convert/$nm_convert;
                $ans2=$nm_convert*6.02214085774;
                $this->param['ans5'] = $ans1;
                $this->param['ans6'] = $ans2;
                $this->param['ans90']=$m_convert;
                $this->param['ans91']=$nm_convert;
                $this->param['RESULT'] = 1;

                return $this->param;
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }
    }

    // Moles To Grams Calculator
    public function moles($request){
        $chemical_selection=$request->chemical_selection;
        $unit=$request->unit;
        $mm_unit=$request->mm_unit;
        $mm=$request->mm;
        $m_unit=$request->m_unit;
        $m=$request->m;
        $nm=$request->nm;
        $nm_unit=$request->nm_unit;


		if($nm_unit == 'mol'){
			$nm_unit = '1';
		}else if($nm_unit == 'mmol'){
			$nm_unit = '2';
		}else if($nm_unit == 'μmol'){
			$nm_unit = '3';
		}else if($nm_unit == 'nmol'){
			$nm_unit = '4';
		}else if($nm_unit == 'pmol'){
			$nm_unit = '5';
		}

		
		if($m_unit == 'ng'){
			$m_unit = '1';
		}else if($m_unit == 'µg'){
			$m_unit = '2';
		}else if($m_unit == 'mg'){
			$m_unit = '3';
		}else if($m_unit == 'g'){
			$m_unit = '4';
		}else if($m_unit == 'dag'){
			$m_unit = '5';
		}else if($m_unit == 'kg'){
			$m_unit = '6';
		}


		if($mm_unit == 'g/mol'){
			$mm_unit = '1';
		}else if($mm_unit == 'dag/mol'){
			$mm_unit = '2';

		}else if($mm_unit == 'dag/mol'){
			$mm_unit = '3';
		}



        if($unit=="1"){
            if(is_numeric($mm) && is_numeric($m) && $mm>0 && $m>0){
                if ($mm_unit=="1"){
                    $mm_convert=$mm*1;
                }elseif ($mm_unit=="2"){
                    $mm_convert=$mm*10;
                }elseif ($mm_unit=="3"){
                    $mm_convert=$mm*1000;
                }
                if ($m_unit=="1") {
                    $m_convert=$m*0.000000001;
                }elseif ($m_unit=="2") {
                    $m_convert=$m*0.000001;
                }elseif ($m_unit=="3") {
                    $m_convert=$m*0.001;
                }elseif ($m_unit=="4") {
                    $m_convert=$m*1;
                }elseif ($m_unit=="5") {
                    $m_convert=$m*10;
                }elseif ($m_unit=="6") {
                    $m_convert=$m*1000;
                }
                $ans1=$m_convert/$mm_convert;
                $ans2=$ans1*6.02214085774;
                $this->param['ans90']=$m_convert;
                $this->param['ans91']=$mm_convert;
                $this->param['ans1'] = $ans1;
                $this->param['ans2'] = $ans2;
                $this->param['RESULT'] = 1;
                return $this->param;
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }if($unit=="2"){
            if(is_numeric($mm) && is_numeric($nm) && $m>0 && $nm>0){
                if ($mm_unit=="1"){
                    $mm_convert=$mm*1;
                }elseif ($mm_unit=="2"){
                    $mm_convert=$mm*10;
                }elseif ($mm_unit=="3"){
                    $mm_convert=$mm*1000;
                }
                if($nm_unit=="1"){
                    $nm_convert=$nm*1;
                }elseif ($nm_unit=="2") {
                    $nm_convert=$nm*0.001;
                }elseif ($nm_unit=="3") {
                    $nm_convert=$nm*0.000001;
                }elseif ($nm_unit=="4") {
                    $nm_convert=$nm*0.000000001;
                }elseif ($nm_unit=="5") {
                    $nm_convert=$nm*0.000000000001;
                }	
                $ans1=$nm_convert*$mm_convert;
                $ans2=$nm_convert*6.02214085774;
                $this->param['ans90']=$mm_convert;
                $this->param['ans91']=$nm_convert;
                $this->param['ans3'] = $ans1;
                $this->param['ans4'] = $ans2;
                $this->param['RESULT'] = 1;
                return $this->param;
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }if($unit=="3"){
            if(is_numeric($m) && is_numeric($nm) && $m>0 && $nm>0){
                if ($m_unit=="1") {
                    $m_convert=$m*0.000000001;
                }elseif ($m_unit=="2") {
                    $m_convert=$m*0.000001;
                }elseif ($m_unit=="3") {
                    $m_convert=$m*0.001;
                }elseif ($m_unit=="4") {
                    $m_convert=$m*1;
                }elseif ($m_unit=="5") {
                    $m_convert=$m*10;
                }elseif ($m_unit=="6") {
                    $m_convert=$m*1000;
                }
                if($nm_unit=="1"){
                    $nm_convert=$nm*1;
                }elseif ($nm_unit=="2") {
                    $nm_convert=$nm*0.001;
                }elseif ($nm_unit=="3") {
                    $nm_convert=$nm*0.000001;
                }elseif ($nm_unit=="4") {
                    $nm_convert=$nm*0.000000001;
                }elseif ($nm_unit=="5") {
                    $nm_convert=$nm*0.000000000001;
                }		
                $ans1=$m_convert/$nm_convert;
                $ans2=$nm_convert*6.02214085774;
                $this->param['ans5'] = $ans1;
                $this->param['ans6'] = $ans2;
                $this->param['ans90']=$m_convert;
                $this->param['ans91']=$nm_convert;
                $this->param['RESULT'] = 1;
                return $this->param;
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }
    }

    // pH Calculator
  	public function ph($request){
		// dd($request->all());
        $concentration=$request->concentration;
        $con_units=$request->con_units;
        if (isset($request->chemical_name)) {
            $chemical_name=$request->chemical_name;
        }else{
            $chemical_name=false;
        }
        $chemical_selection=$request->chemical_selection;
        $post_space=$request->post_space;
        $po_units=$request->po_units;
        $f_length=$request->f_length;
        $fl_units=$request->fl_units;
        $operation=$request->operation;
        $second=$request->second;

		function convert_units($a,$b){
			if($b=="M"){
				$convert=$a*1;
			}elseif ($b=="mM") {
				$convert=$a*0.001;	
			}elseif ($b=="µM") {
				$convert=$a*0.000001;	
			}elseif ($b=="nM") {
				$convert=$a*0.000000001;	
			}elseif ($b=="pM") {
				$convert=$a*0.000000000001;
			}elseif ($b=="fM") {
				$convert=$a*0.000000000000001;
			}elseif ($b=="aM") {
				$convert=$a*0.000000000000000001;
			}elseif ($b=="zM") {
				$convert=$a*0.000000000000000000001;
			}
			return $convert;
		}
		function convert_weight($c,$d){
			if($d=="ng"){
				$convert=$c/1000000000;
			}elseif ($d=="µg") {
				$convert=$c/1000000;	
			}elseif ($d=="mg") {
				$convert=$c/1000;	
			}elseif ($d=="g") {
				$convert=$c*1;	
			}elseif ($d=="dag") {
				$convert=$c*10;
			}elseif ($d=="kg") {
				$convert=$c*1000;
			}elseif ($d=="gr") {
				$convert=$c/15.432;
			}elseif ($d=="dr") {
				$convert=$c*3.41;
			}elseif ($d=="lbs") {
				$convert=$c*454;
			}elseif ($d=="stones") {
				$convert=$c*6350;
			}elseif ($d=="oz t") {
				$convert=$c*31.103;
			}elseif ($d=="oz") {
				$convert=$c*28.35;
			}elseif ($d=="t") {
				$convert=$c*1000000;
			}
			return $convert;
		}
		function convert_volume($x,$y){
			if($y=="mm³"){
				$convert=$x/1000000;
			}elseif ($y=="cm³") {
				$convert=$x/1000;	
			}elseif ($y=="dm³") {
				$convert=$x*1;	
			}elseif ($y=="m³") {
				$convert=$x*1000;	
			}elseif ($y=="in³") {
				$convert=$x*61.024;
			}elseif ($y=="ft³") {
				$convert=$x*28.317;
			}elseif ($y=="ml") {
				$convert=$x/1000;
			}elseif ($y=="cl") {
				$convert=$x/100;
			}elseif ($y=="liters") {
				$convert=$x*1;
			}elseif ($y=="US gal") {
				$convert=$x*3.785;
			}elseif ($y=="UK gal") {
				$convert=$x*4.546;
			}elseif ($y=="US fl oz") {
				$convert=$x/33.814;
			}elseif ($y=="UK fl oz") {
				$convert=$x/35.195;
			}
			return $convert;
		}

		if ($chemical_selection=="1") {
			if ($concentration > 0) {
				$concentration=convert_units($concentration,$con_units);
				$res1=$chemical_name*$concentration;
				$res2=sqrt($res1);
				$res3=log10($res2);
				$pH=$res3 * -1;
				$H=pow(10,-$pH);
				$pho=14-$pH;
				$OH=pow(10,-$pho);
				$pk_a=log10($chemical_name);
				$pka=$pk_a * -1;
				$pH=number_format($pH,4);
				// $H=number_format($H,4);
				$pho=number_format($pho,2);
				$pka=number_format($pka,3);
			}else{
                $this->param['error'] = 'Please! Concentration greater than 0.';
                return $this->param;
			}
		}elseif ($chemical_selection=="2") {
			if ($concentration > 0) {
				$concentration=convert_units($concentration,$con_units);
				$res1=$chemical_name*$concentration*4;
				$res2=sqrt($res1);
				$re=($res2-$chemical_name)/2;
				$ans1=0.00000000000001/$re;
				$res3=log10($ans1);
				$pH=$res3 * -1;
				$H=pow(10,-$pH);
				$pho=14-$pH;
				$OH=pow(10,-$pho);
				$pk_a=log10($chemical_name);
				$pka=$pk_a * -1;
				$pH=number_format($pH,4);
				// $H=number_format($H,4);
				$pho=number_format($pho,2);
				$pka=number_format($pka,3);
			}else{
                $this->param['error'] = 'Please! Concentration greater than 0.';
                return $this->param;
			}
		}elseif ($chemical_selection=="3") {
			if ($f_length>0 && $post_space>0) {
				$f_length=convert_weight($f_length,$fl_units);
				$post_space=convert_volume($post_space,$po_units);
				list($v, $m) = explode('&', $chemical_name);
				// $moles=$f_length/$m;
				// $concentration=$moles/$post_space;

				if ($m != 0) {
					$moles = $f_length / $m;
				} else {
					$moles = 0; // Or handle the error as needed
				}
				if ($post_space != 0) {
					$concentration = $moles / $post_space;
				} else {
					$concentration = 0; // Or handle the error as needed
				}

				$res1=$v*$concentration;
				$res2=sqrt($res1);
				$res3=log10($res2);
				$pH=$res3 * -1;
				$H=pow(10,-$pH);
				$pho=14-$pH;
				$OH=pow(10,-$pho);
				$pk_a=log10($v);
				$pka=$pk_a * -1;
				$pH=number_format($pH,4);
				// $H=number_format($H,4);
				$pho=number_format($pho,2);
				$pka=number_format($pka,3);
			}else{
                $this->param['error'] = 'Please! Input greater than 0.';
                return $this->param;
			}
		}elseif ($chemical_selection=="4") {
			if ($f_length>0 && $post_space>0) {
				$f_length=convert_weight($f_length,$fl_units);
				$post_space=convert_volume($post_space,$po_units);
				list($v, $m) = explode('&', $chemical_name);
				// $moles=$f_length/$m;
				// $concentration=$moles/$post_space;

				if ($m != 0) {
					$moles = $f_length / $m;
				} else {
					$moles = 0; // Or handle the error as needed
				}
				if ($post_space != 0) {
					$concentration = $moles / $post_space;
				} else {
					$concentration = 0; // Or handle the error as needed
				}


				$res3=log10($concentration);
				$pho=$res3 * -1;
				$pH=14-$pho;
				$H=pow(10,-$pH);
				$OH=pow(10,-$pho);
				$pk_a=log10($v);
				$pka=$pk_a * -1;
				$pH=number_format($pH,4);
				// $OH=number_format($OH,4);
				$pho=number_format($pho,2);
				$pka=number_format($pka,3);
			}else{
                $this->param['error'] = 'Please! Input greater than 0.';
                return $this->param;
			}
		}elseif ($chemical_selection=="5") {
			if ($operation=="1") {
				if ($concentration > 0) {
					$concentration=convert_units($concentration,$con_units);
					$res3=log10($concentration);
					$pH=$res3 * -1;
					$pho=14-$pH;
					$OH=pow(10,-$pho);
					$pH=number_format($pH,4);
					$pho=number_format($pho,4);
				}else{
                    $this->param['error'] = 'Please! Input greater than 0.';
                    return $this->param;
				}
			}elseif ($operation=="2") {
				if (is_numeric($second)) {
					$pH=14-$second;
					$H=pow(10,-$pH);
					$OH=pow(10,-$second);
				}else{
                    $this->param['error'] = 'Please! Input greater than 0.';
                    return $this->param;
				}
			}elseif ($operation=="3") {
				if ($concentration > 0) {
					$concentration=convert_units($concentration,$con_units);
					$res3=log10($concentration);
					$pho=$res3 * -1;
					$pH=14-$pho;
					$H=pow(10,-$pH);
				}else{
                    $this->param['error'] = 'Please! Input greater than 0.';
                    return $this->param;
				}
			}
		} 
		if (!empty($pH)) {
			$this->param['pH'] = $pH;
		}
		if (!empty($pho)) {
			$this->param['pho'] = $pho;
		}
		if (!empty($OH)) {
			$this->param['OH'] = $OH;
		}
		if (!empty($H)) {
			$this->param['H'] = $H;
		}
		if (!empty($pka)) {
			$this->param['pka'] = $pka;
		}
		$this->param['RESULT'] = 1;
		// dd($this->param);
        return $this->param;
	}

    // Limiting Reactent Calculator
	public function limiting($request){
        $eq=trim($request->eq);

	    if(preg_match("/\<|\>|\&|php|print_r|print|echo|script|&|%/i",$eq)){
            $this->param['error'] = 'Please Enter Valid Input.';
            return $this->param;
	    }
	    if(!empty($eq)){
            $parem=$eq;
            $parem=str_replace(' ', '', $parem);
            $parem=str_replace('%20', '', $parem);
            $parem=str_replace('+', 'plus' , $parem);
            $parem=str_replace('{', '(', $parem);
            $parem=str_replace('}', ')', $parem);
            $parem=str_replace('e^', 'exp', $parem);
            $parem=str_replace('exp^', 'exp', $parem);
            $parem=str_replace('^', '**', $parem);
            $parem=str_replace('e^sqrt(x)', 'exp(2*x)', $parem);
            $exp=explode('=',$parem);
            $r=$exp[0];
            $p=$exp[1];
            $option=2;

            try{
                $response = Http::timeout(120)->get('http://167.172.134.148/limiting', [
                    'r' => $r,
                    'p' => $p,
                ]);
                $buffer = $response->body();
                $buffer = explode('@@@', $buffer);
                $inp=str_replace('plus', '+', $parem);

                $this->param['inp'] = $inp;
                $this->param['be'] = $buffer[0];
                $this->param['mols'] = $buffer[1];
                $this->param['atoms'] = $buffer[2];
                $this->param['chemical_equation'] = $eq;
                $this->param['option'] = $option;
                $this->param['RESULT'] = 1;
                return $this->param;
            }catch (\Exception $response){
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
	    }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
	    } 
  	}

     // Equilibrium Constant Calculator
  	public function equilibrium($request){
        $concentration_one=$request->concentration_one;
        $concentration_one_unit=$request->concentration_one_unit;
        $concentration_two=$request->concentration_two;
        $concentration_two_unit=$request->concentration_two_unit;
        $concentration_three=$request->concentration_three;
        $concentration_three_unit=$request->concentration_three_unit;
        $concentration_four=$request->concentration_four;
        $concentration_four_unit=$request->concentration_four_unit;
        $a=$request->a;
        $b=$request->b;
        $c=$request->c;
        $d=$request->d;
        $selection=$request->selection;
        $chemical_equation=$request->chemical_equation;
        $total_pressure=$request->total_pressure;

        function convert_unit($a,$b){
           if($a=="M"){
               $val1=$b*1;
           }else if($a=="mM"){
               $val1=$b*0.001;
           }else if($a=="μM"){
               $val1=$b*0.000001;
           }else if($a=="nM"){
               $val1=$b*0.000000001;
           }else if($a=="pM"){
               $val1=$b*0.000000000001;
           }else if($a=="fM"){
               $val1=$b*0.000000000000001;
           }else if($a=="aM"){
               $val1=$b*0;
           }else if($a=="zM"){
               $val1=$b*0;
           }else if($a=="yM"){
               $val1=$b*0;
           }
           return $val1;
        }

        if(preg_match("/\<|\>|\&|php|print_r|print|echo|script|&|%/i",$chemical_equation)){
            $this->param['error'] = 'Please Enter Valid Input.';
            return $this->param;
        }
	
        if(!empty($chemical_equation)){
            if($selection=="1"){
                if(is_numeric($concentration_one) && is_numeric($concentration_two) && is_numeric($concentration_three)  && is_numeric($concentration_four) && is_numeric($a) && is_numeric($b) && is_numeric($c) && is_numeric($d)){
                    $first_value=convert_unit($concentration_one_unit,$concentration_one);
                    $second_value=convert_unit($concentration_two_unit,$concentration_two);
                    $third_value=convert_unit($concentration_three_unit,$concentration_three);
                    $four_value=convert_unit($concentration_four_unit,$concentration_four);
                    $third_power=pow($third_value,$c);
                    $four_power=pow($four_value,$d);
                    $second_power=pow($second_value,$b);
                    $first_power=pow($first_value,$a);
                    $Kc=($third_power*$four_power)/($second_power*$first_power);
                    $this->param['answer'] = $Kc;
                    $this->param['opt']=$selection;
                    //$this->param['chemical_equation']=$chemical_equation;
                    //$this->param['total_pressure']=$total_pressure;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                    //echo (pow($third_value,$c))*(pow($four_value,$d))/(pow($second_value,$b))*(pow($first_value,$a));
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }else if($selection=="2"){
                if(is_numeric($total_pressure) && $chemical_equation!=""){
					
                    $this->param['equation'] = $chemical_equation;
                    $this->param['total_pressure']=$total_pressure;
                    $this->param['opt']=$selection;
                    $this->param['RESULT'] = 1;
                    return $this->param;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
        }
    }


    // Redox Reaction Calculator
  	public function redox($request){
        $eq=trim($request->eq);

        if (!empty($eq)) {
            $eq=str_replace('plus',"+",$eq);
            $this->param['eq'] = $eq;
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }	
    }

    // Atoms to Moles Calculator
  	public function atoms($request){
        $form=trim($request->form);
        $x=trim($request->x);

        if (is_numeric($x)) {
            if ($form=='raw') {
                $ans=$x*1.66053907e-24;
            }else{
                $ans=$x*6.02214076e+23;
            }

            $this->param['ans'] = $ans;
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Grams To Atoms Calculator
  	public function gram_atm($request){
		//  dd($request->all());
        $form=trim($request->form);
        $x=trim($request->x);
        $y=trim($request->y);

        if (is_numeric($x)) {
            $na=6.02214076e23;
            if ($form=='raw') {
                $ans=($na*$y)/$x;
            }else{
                $ans=($y*$x)/$na;
            }
            $this->param['ans'] = sprintf('%.3e', $ans);
            $this->param['RESULT'] = 1;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Boyle's Law Calculator
    public function boyles($request){
        $find=$request->find;
        $v1=$request->v1;
        $v1_unit=$request->v1_unit;
        $p1=$request->p1;
        $p1_unit=$request->p1_unit;
        $v2=$request->v2;
        $v2_unit=$request->v2_unit;
        $p2=$request->p2;
        $p2_unit=$request->p2_unit;
        $R=$request->R;
        $temp=$request->temp;
        $temp_unit=$request->temp_unit;
        $amount=$request->amount;

		function pre($unit,$value){
			if($unit=="Pa"){
				$val1=$value*1;
			}else if($unit=="Bar"){
				$val1=$value*100000;
			}else if($unit=="psi"){
				$val1=$value*6895;
			}else if($unit=="at"){
				$val1=$value*98068;
			}else if($unit=="atm"){
				$val1=$value*101325;
			}else if($unit=="Torr"){
				$val1=$value*133.32;
			}else if($unit=="hPa"){
				$val1=$value*100;
			}else if($unit=="kPa"){
				$val1=$value*1000;
			}else if($unit=="MPa"){
				$val1=$value*1000;
			}else if($unit=="Gpa"){
				$val1=$value*1000000000;
			}else if($unit=="in Hg"){
				$val1=$value*3386.4;
			}else if($unit=="mmHg"){
				$val1=$value*133.32;
			}
			return $val1;
		}
		function vol($unit2,$value2){
			if($unit2=="mm³"){
				$val2=$value2*0.000000001;
			}else if($unit2=="cm³"){
				$val2=$value2*0.000001;
			}else if($unit2=="dm³"){
				$val2=$value2*0.001;
			}else if($unit2=="m³"){
				$val2=$value2*1;
			}else if($unit2=="in³"){
				$val2=$value2*0.000016387;
			}else if($unit2=="ft³"){
				$val2=$value2*0.028317;
			}else if($unit2=="yd³"){
				$val2=$value2*0.7646;
			}else if($unit2=="ml"){
				$val2=$value2*0.000001;
			}else if($unit2=="liters"){
				$val2=$value2*0.001;
			}
			return $val2;
		}
		function temp($unit3,$value3){
			if($unit3=="°C"){
				$val3=$value3+273.15;
			}else if($unit3=="°F"){
				$val3=($value3-32)*(5/9)+273.15;
			}else if($unit3=="K"){
				$val3=$value3*1;
			}
			return $val3; 
		}

		if($find=="1"){//Find Volume V2
			if(is_numeric($p1) && is_numeric($v1) && is_numeric($p2)){
				$method=1;
				$pressure_one=pre($p1_unit,$p1);
				$volume_one=vol($v1_unit,$v1);
				$pressure_two=pre($p2_unit,$p2);
				$formula=($pressure_one*$volume_one)/($pressure_two);
				$content="Final Volume (V₂)";
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($find=="2"){//Find Pressure P2
			if(is_numeric($p1) && is_numeric($v1) && is_numeric($v2)){
				$method=2;
				$pressure_one=pre($p1_unit,$p1);
				$volume_one=vol($v1_unit,$v1);
				$volume_two=vol($v2_unit,$v2);
				$formula=$pressure_one*($volume_one/$volume_two);
				$content="Final Pressure (P₂)";
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}
		else if($find=="3"){//Find Volume V1
			if(is_numeric($p1) && is_numeric($p2) && is_numeric($v2)){
				$method=3;
				$pressure_one=pre($p1_unit,$p1);
				$pressure_two=pre($p2_unit,$p2);
				$volume_two=vol($v2_unit,$v2);
				$formula=$pressure_two*($volume_two/$pressure_one);
				$content="Initial Volume (V₁)";
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}
		else if($find=="4"){//Find Pressure P1
			if(is_numeric($v1) && is_numeric($v2) && is_numeric($p2)){
				$method=4;
				$pressure_two=pre($p2_unit,$p2);
				$volume_one=vol($v1_unit,$v1);
				$volume_two=vol($v2_unit,$v2);
				$formula=$pressure_two*($volume_two/$volume_one);
				$content="Initial Pressure (P₁)";
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($find=="5"){//Find Temperature 
			if(is_numeric($p1) && is_numeric($v1) && is_numeric($R) && is_numeric($amount)){
				$method=5;
				$final=($p1*$v1)/($R*$amount);
				$content="Temperature";
				$this->param['method']=$method;
				$this->param['content']=$content;
				$this->param['pooran']=$final;
				$this->param['RESULT'] = 1;
                return $this->param;
			}
		}else if($find=="6"){//Find Amount of Gas
			if(is_numeric($p1) && is_numeric($v1) && is_numeric($R) && is_numeric($temp)){
				$method=6;
				$temp_value=temp($temp_unit,$temp);
				$f=$p1*$v1;
				$s=$R*$temp_value;
				$final=$f/$s;
				$content="Amount of gas (n)";
				$formula="";	
				$this->param['content']=$content;
				$this->param['final']=$final;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}
		$temp=295;
		$first=$p1*$v1;
		$second=$R*$temp;
		$final=$first/$second;
		$this->param['ans']=$formula;
		$this->param['method']=$method;
		$this->param['temp']=$temp;
		$this->param['n']=round($final, 3);
		$this->param['content']=$content;
		$this->param['RESULT'] = 1;


        return $this->param;
	}

    // Combined Gas Law Calculator
	public function combined($request){
		// dd($request->all());
        $calculation=$request->calculation;
        $pressure_one=$request->pressure_one;
        $pressure_one_unit=$request->pressure_one_unit;
        $pressure_two=$request->pressure_two;
        $pressure_two_unit=$request->pressure_two_unit;
        $volume_one=$request->volume_one;
        $volume_one_unit=$request->volume_one_unit;
        $volume_two=$request->volume_two;
        $volume_two_unit=$request->volume_two_unit;
        $temp_one=$request->temp_one;
        $temp_one_unit=$request->temp_one_unit;
        $temp_two=$request->temp_two;
        $temp_two_unit=$request->temp_two_unit;

		function pre($unit,$value){
			if($unit=="Pa"){
				$val1=$value*1;
			}else if($unit=="kPa"){
				$val1=$value*1000;
			}else if($unit=="Bar"){
				$val1=$value*100000;
			}else if($unit=="atm"){
				$val1=$value*101325;
			}else if($unit=="hPa"){
				$val1=$value*100;
			}else if($unit=="mbar"){
				$val1=$value*100;
			}else if($unit=="mmHg"){
				$val1=$value*133.32;
			}
			return $val1;
		}
		function vol($unit2,$value2){
			if($unit2=="m³"){
				$val2=$value2*1;
			}else if($unit2=="l"){
				$val2=$value2*0.001;
			}else if($unit2=="ml"){
				$val2=$value2*0.000001;
			}else if($unit2=="ft³"){
				$val2=$value2*0.0283168;
			}else if($unit2=="in³"){
				$val2=$value2*1.63871e-5;
			}
			return $val2;
		}
		function temp($unit3,$value3){
			if($unit3=="°C"){
				$val3=$value3+273.15;
			}else if($unit3=="°F"){
				$val3=($value3-32)*(5/9)+273.15;
			}else if($unit3=="K"){
				$val3=$value3*1;
			}
			return $val3; 
		}

		if($calculation=="1"){//Temperature Two
            if(is_numeric($pressure_one) && is_numeric($pressure_two) && is_numeric($volume_one) && is_numeric($volume_two) && is_numeric($temp_one)){
				$method=1;
				$pressure_two_value=pre($pressure_two_unit,$pressure_two);
				$pressure_one_value=pre($pressure_one_unit,$pressure_one);
				$volume_two_value=vol($volume_two_unit,$volume_two);
				$volume_one_value=vol($volume_one_unit,$volume_one);
				$temp_one_value=temp($temp_one_unit,$temp_one);
				$tf =((($pressure_two_value*$volume_two_value*$temp_one_value)/($pressure_one_value*$volume_one_value))*100)/100;
				$this->param['temperature']=$tf;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($calculation=="2"){//Volume One
			$method=2;
			if(is_numeric($pressure_one) && is_numeric($pressure_two) && is_numeric($temp_two) && is_numeric($volume_two) && is_numeric($temp_one)){
				$pressure_two_value=pre($pressure_two_unit,$pressure_two);
				$pressure_one_value=pre($pressure_one_unit,$pressure_one);
				$volume_two_value=vol($volume_two_unit,$volume_two);
				$temp_two_value=temp($temp_two_unit,$temp_two);
				$temp_one_value=temp($temp_one_unit,$temp_one);
				$vi =((($pressure_two_value*$volume_two_value*$temp_one_value)/($temp_two_value*$pressure_one_value))*100)/100;
				$this->param['volume']=$vi;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($calculation=="3"){//Pressure One
			$method=3;
			if(is_numeric($volume_one) && is_numeric($pressure_two) && is_numeric($temp_two) && is_numeric($volume_two) && is_numeric($temp_one)){
				$pressure_two_value=pre($pressure_two_unit,$pressure_two);
				$volume_one_value=vol($volume_one_unit,$volume_one);
				$volume_two_value=vol($volume_two_unit,$volume_two);
				$temp_two_value=temp($temp_two_unit,$temp_two);
				$temp_one_value=temp($temp_one_unit,$temp_one);
				$pi =((($pressure_two_value*$volume_two_value*$temp_one_value)/($temp_two_value*$volume_one_value))*100)/100;
				$this->param['pressure']=$pi;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($calculation=="4"){//Temperature One
			$method=4;
			if(is_numeric($volume_one) && is_numeric($pressure_two) && is_numeric($temp_two) && is_numeric($volume_two) && is_numeric($pressure_one)){
				 $pressure_two_value=pre($pressure_two_unit,$pressure_two);
				 $volume_one_value=vol($volume_one_unit,$volume_one);
				 $volume_two_value=vol($volume_two_unit,$volume_two);
				 $temp_two_value=temp($temp_two_unit,$temp_two);
				 $pressure_one_value=pre($pressure_one_unit,$pressure_one);
				$ti=((($pressure_one_value*$volume_one_value*$temp_two_value)/($pressure_two_value*$volume_two_value))*100)/100;
				$this->param['temperature']=$ti;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($calculation=="5"){//Volume Two
			$method=5;
			if(is_numeric($volume_one) && is_numeric($pressure_two) && is_numeric($temp_two) && is_numeric($temp_one) && is_numeric($pressure_one)){
				 $pressure_two_value=pre($pressure_two_unit,$pressure_two);
				 $volume_one_value=vol($volume_one_unit,$volume_one);
				 $temp_one_value=temp($temp_one_unit,$temp_two);
				 $temp_two_value=temp($temp_two_unit,$temp_two);
				 $pressure_one_value=pre($pressure_one_unit,$pressure_one);
				 $vf=((($temp_two_value*$pressure_one_value*$volume_one_value)/($temp_one_value*$pressure_two_value))*100)/100;
				 $this->param['volume']=$vf;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($calculation=="6"){//Pressure Two
			$method=6;
			if(is_numeric($volume_one) && is_numeric($pressure_one) && is_numeric($temp_two) && is_numeric($volume_two) && is_numeric($temp_one)){
				$pressure_one_value=pre($pressure_one_unit,$pressure_one);
				$volume_one_value=vol($volume_one_unit,$volume_one);
				$volume_two_value=vol($volume_two_unit,$volume_two);
				$temp_two_value=temp($temp_two_unit,$temp_two);
				$temp_one_value=temp($temp_one_unit,$temp_one);
				$pf=((($temp_two_value*$pressure_one_value*$volume_one_value)/($temp_one_value*$volume_two_value))*100)/100;
				$this->param['pressure']=$pf;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}
		$this->param['method']=$method;
		$this->param['RESULT'] = 1;
        return $this->param;
	}

    // PPM Calculator
	public function ppm($request){
		//  dd($request->all());
        $type = $request->calculator_name;
        $operations = $request->operations;
        $first = $request->first;
        $drop1 = $request->drop1;
        $drop2 = $request->drop2;
        $drop3 = $request->drop3;
        $second = $request->second;
        $drop4 = $request->drop4;
        $third = $request->third;

		if ($type == "calculator1") {
			if ($operations=="1") {
				if (is_numeric($first)) {
					$answer1 = $first;
					$answer2 = ($first * 100);
					$answer3 = ($first * 1000);
					$answer4 = ($first * 1000000);
					$answer5 = ($first * 1000000000);
					$answer6 = ($first * 1000000000000);
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}else if ($operations=="2") {
				if (is_numeric($first)) {
					$answer1 = $first / 100;
					$answer2 = $first;
					$answer3 = ($first * 10);
					$answer4 = ($first * 10000);
					$answer5 = ($first * 10000000);
					$answer6 = ($first * 10000000000);
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}else if ($operations=="3") {
				if (is_numeric($first)) {
					$answer1 = $first / 1000;
					$answer2 = ($first / 10);
					$answer3 = $first;
					$answer4 = ($first * 1000);
					$answer5 = ($first * 1000000);
					$answer6 = ($first * 1000000000);
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}else if ($operations=="4") {
				if (is_numeric($first)) {
					$answer1 = $first / 1000000;
					$answer2 = ($first / 10000);
					$answer3 = ($first / 1000);
					$answer4 = $first;
					$answer5 = ($first * 1000);
					$answer6 = ($first * 1000000);
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}else if ($operations=="5") {
				if (is_numeric($first)) {
					$answer1 = $first / 1000000000;
					$answer2 = ($first / 10000000);
					$answer3 = ($first / 1000000);
					$answer4 = ($first / 1000);
					$answer5 = $first;
					$answer6 = ($first * 1000);
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}else if ($operations=="6") {
				if (is_numeric($first)) {
					$answer1 = $first / 1000000000000;
					$answer2 = ($first / 10000000000);
					$answer3 = ($first / 1000000000);
					$answer4 = ($first / 1000000);
					$answer5 = ($first / 1000);
					$answer6 = $first;
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}
			$this->param['answer1'] = $answer1;
			$this->param['answer2'] = $answer2;
			$this->param['answer3'] = $answer3;
			$this->param['answer4'] = $answer4;
			$this->param['answer5'] = $answer5;
			$this->param['answer6'] = $answer6;
		}elseif ($type == "calculator2") {
			if (($drop1 == 1) || ($drop1 == 2)) {
				if ($drop2 == 1) {
					if ($drop4 == 1) {
						if (is_numeric($second) && is_numeric($third)) {
							$jawab1 = $third * $second;
							$jawab2 = $jawab1 / 24.45;
						}else{
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					}else if ($drop4 == 2) {
						if (is_numeric($second) && is_numeric($third)) {
							$jawab1 = $third * 24.45;
							$jawab2 = $jawab1 / $second;
						}else{
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					}
					$jawab2 = round($jawab2, 3);
					$this->param['jawab2'] = $jawab2;
				}else if ($drop2 == 2) {
					if ($drop4 == 1) {
						if (is_numeric($second) && is_numeric($third)) {
							$jawab1 = $third * $second;
							$jawab3 = $jawab1 / 24.45;
							$jawab2 = $jawab3 / 100000000000;
						}else{
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					}else if ($drop4 == 2) {
						if (is_numeric($second) && is_numeric($third)) {
							$jawab1 = $third * 24.45;
							$jawab3 = $jawab1 / $second;
							$jawab2 = $jawab3 * 100000000000;
						}else{
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					}
					// $jawab2 = round($jawab2, 5);
					$this->param['jawab2'] = $jawab2;
				}
			}else if ($drop1 == 3) {
				if ($drop2 == 1) {
					if ($drop4 == 1) {
						if (is_numeric($third)) {
							$jawab2 = $third * 1.29;
						}else{
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					}else if ($drop4 == 2) {
						if (is_numeric($third)) {
							$jawab2 = $third * 0.773;
						}else{
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					}
					$jawab2 = round($jawab2, 3);
					$this->param['jawab2'] = $jawab2;
				}else if ($drop2 == 2) {
					if ($drop4 == 1) {
						if (is_numeric($third)) {
							$jawab2 = $third * 1000;
						}else{
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					}else if ($drop4 == 2) {
						if (is_numeric($third)) {
							$jawab2 = $third / 1000;
						}else{
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					}
					$jawab2 = round($jawab2, 3);
					$this->param['jawab2'] = $jawab2;
				}
			}
		}
		$this->param['type'] = $type;

		$this->param['RESULT'] = 1;
        return $this->param;
	}

    // Gay Lussac's Law Calculator
	public function gay($request){
		// dd($request->all());
        $selection=$request->selection;
        $p1=$request->p1;
        $p1_unit=$request->p1_unit;
        $t1=$request->t1;
        $t1_unit=$request->t1_unit;
        $p2=$request->p2;
        $p2_unit=$request->p2_unit;
        $t2=$request->t2;
        $t2_unit=$request->t2_unit;
        $R=$request->R;
        $amount=$request->amount;
        $v1=$request->v1;

		function pre($unit,$value){
			if($unit=="Pa"){
				$val1=$value*1;
			}else if($unit=="Bar"){
				$val1=$value*100000;
			}else if($unit=="psi"){
				$val1=$value*6895;
			}else if($unit=="at"){
				$val1=$value*98068;
			}else if($unit=="atm"){
				$val1=$value*101325;
			}else if($unit=="Torr"){
				$val1=$value*133.32;
			}else if($unit=="hPa"){
				$val1=$value*100;
			}else if($unit=="kPa"){
				$val1=$value*1000;
			}else if($unit=="MPa"){
				$val1=$value*1000;
			}else if($unit=="GPa"){
				$val1=$value*1000000000;
			}else if($unit=="inHg"){
				$val1=$value*3386.4;
			}else if($unit=="mmHg"){
				$val1=$value*133.32;
			}
			return $val1;
		}
		function vol($unit2,$value2){
			if($unit2=="mm³"){
				$val2=$value2*0.000000001;
			}else if($unit2=="cm³"){
				$val2=$value2*0.000001;
			}else if($unit2=="dm³"){
				$val2=$value2*0.001;
			}else if($unit2=="m³"){
				$val2=$value2*1;
			}else if($unit2=="in³"){
				$val2=$value2*0.000016387;
			}else if($unit2=="ft³"){
				$val2=$value2*0.028317;
			}else if($unit2=="yd³"){
				$val2=$value2*0.7646;
			}else if($unit2=="ml"){
				$val2=$value2*0.000001;
			}else if($unit2=="liters"){
				$val2=$value2*0.001;
			}
			return $val2;
		}
		function temp($unit3,$value3){
			if($unit3=="°C"){
				$val3=$value3+273.15;
			}else if($unit3=="°F"){
				$val3=($value3-32)*(5/9)+273.15;
			}else if($unit3=="K"){
				$val3=$value3*1;
			}
			return $val3; 
		}
		if($selection=="1"){//Final Temperature (T2)
			$method=1;
			if(is_numeric($p1) && is_numeric($p2) && is_numeric($t1)){
				$p1_value=pre($p1_unit,$p1);
				$p2_value=temp($p2_unit,$p2);
				$t1_value=temp($t1_unit,$t1);
				// dd($p2_value);
				$temp2=($t1_value*$p2_value)/$p1_value;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($selection=="2"){//Final Pressure (P2)
			$method=2;
			if(is_numeric($t1) && is_numeric($t2) && is_numeric($p1)){
				$p1_value=pre($p1_unit,$p1);
				$t1_value=temp($t1_unit,$t1);
				$t2_value=temp($t2_unit,$t2);
				$temp2=($p1_value*$t2_value)/$t1_value;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($selection=="3"){//Initial Pressure (P1)
			$method=3;
			if(is_numeric($t1) && is_numeric($t2) && is_numeric($p2)){
				$p2_value=pre($p2_unit,$p2);
				$t1_value=temp($t1_unit,$t1);
				$t2_value=temp($t2_unit,$t2);
				$temp2=($t1_value*$p2_value)/$t2_value;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($selection=="4"){//Initial Temperature (T1)
			$method=4;
			if(is_numeric($p1) && is_numeric($p2) && is_numeric($t2)){
				$p1_value=pre($p1_unit,$p1);
				$p2_value=temp($p2_unit,$p2);
				$t2_value=temp($t2_unit,$t2);

				$temp2=($t2_value/$p2_value)*$p1_value;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($selection=="5"){
			$method=5;
			if(is_numeric($p1) && is_numeric($t1) && is_numeric($amount) && is_numeric($R)){
				$p1_value=pre($p1_unit,$p1);
				$p2_value=temp($p2_unit,$p2);
				$t2_value=temp($t2_unit,$t2);
				// dd($p2_value);
				$calculate_volume=($amount*$R*$t1)/$p1;
				$this->param['calculate_volume']=$calculate_volume;
				$this->param['method']=$method;
				$this->param['RESULT'] = 1;
				dd($this->param);
                return $this->param;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($selection=="6"){
			$method=6;
			if(is_numeric($p1) && is_numeric($t1) && is_numeric($v1) && is_numeric($R)){
				$n=($p1*$v1)/($R*$t1);
				$this->param['n']=$n;
				$this->param['method']=$method;
				$this->param['RESULT'] = 1;
                return $this->param;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}
		$amount_of_gas=1;
		$calculate_volume=($amount_of_gas*$R*$t1)/$p1;
		$this->param['volume']=$calculate_volume;
		$this->param['amount_of_gas']=$amount_of_gas;
		$this->param['method']=$method;
		$this->param['temp']=$temp2;
		$this->param['method']=$method;
		$this->param['RESULT'] = 1;
            // dd($this->param);

        return $this->param;
	}

    // Mass Percent Calculator
	public function mass($request){
		// dd($request->all());
        $find=$request->find;
        $mass_solute=$request->mass_solute;
        $mass_solute_unit=$request->mass_solute_unit;
        $mass_solvent=$request->mass_solvent;
        $mass_solvent_unit=$request->mass_solvent_unit;
        $mass_percentage=$request->mass_percentage;
        $mass_chemical=$request->mass_chemical;
        $mass_chemical_unit=$request->mass_chemical_unit;
        $total_mass_compound=$request->total_mass_compound;
        $total_mass_compound_unit=$request->total_mass_compound_unit;
        $first_value=$request->first_value;
        $first_value_unit=$request->first_value_unit;
        $second_value=$request->second_value;
        $second_value_unit=$request->second_value_unit;
        $third_value=$request->third_value;
        $third_value_unit=$request->third_value_unit;
        $four_value=$request->four_value;
        $four_value_unit=$request->four_value_unit;
        $five_value=$request->five_value;
        $five_value_unit=$request->five_value_unit;
        $six_value=$request->six_value;
        $six_value_unit=$request->six_value_unit;

		function mass_convert($unit2,$value2){
			if($unit2=="µg"){
				$val3=$value2*0.000000001;
			}else if($unit2=="mg"){
				$val3=$value2*0.000001;
			}else if($unit2=="g"){
				$val3=$value2*0.001;
			}else if($unit2=="dag"){
				$val3=$value2*0.01;
			}else if($unit2=="kg"){
				$val3=$value2*1;
			}else if($unit2=="t"){
				$val3=$value2*1000;
			}else if($unit2=="oz"){
				$val3=$value2*0.02835;
			}else if($unit2=="lbs"){
				$val3=$value2*0.4536;
			}
			return $val3;
		}
		function find_atomic_mass($value_unit,$value){
			if($value_unit=="Atomic mass amu"){
				$val1=12;
			}else if($value_unit=="H (Hydrogen)"){
				$val1=1.00784*$value;
				$val2=1.00784;
			}else if($value_unit=="He (Helium)"){
				$val1=4.002602*$value;
				$val2=4.002602;
			}else if($value_unit=="Li (Lithium)"){
				$val1=6.941*$value;
				$val2=6.941;
			}else if($value_unit=="Be (Beryllium)"){
				$val1=9.0122*$value;
				$val2=9.0122;
			}else if($value_unit=="B (Boron)"){
				$val1=10.811*$value;
				$val2=10.811;
			}else if($value_unit=="C (Carbon)"){
				$val1=12.011*$value;
				$val2=12.011;
			}else if($value_unit=="N (Nitrogen)"){
				$val1=14.0067*$value;
				$val2=14.0067;
			}else if($value_unit=="O (Oxygen)"){
				$val1=15.9994*$value;
				$val2=15.9994;
			}else if($value_unit=="F (Fluorine)"){
				$val1=18.998403*$value;
				$val2=18.998403*$value;
			}else if($value_unit=="Ne (Neon)"){
				$val1=20.179*$value;
				$val2=20.179;
			}else if($value_unit=="Na (Sodium)"){
				$val1=22.98977*$value;
				$val2=22.98977;
			}else if($value_unit=="Mg (Magnesium)"){
				$val1=24.305*$value;
				$val2=24.305;
			}else if($value_unit=="Al (Aluminium)"){
				$val1=26.98154*$value;
				$val2=26.98154;
			}else if($value_unit=="Si (Silicon)"){
				$val1=28.0855*$value;
				$val2=28.0855;
			}else if($value_unit=="P (Phosphorus)"){
				$val1=30.97376*$value;
				$val2=30.97376;
			}else if($value_unit=="S (Sulfur)"){
				$val1=32.06*$value;
				$val2=32.06;
			}else if($value_unit=="Cl (Chlorine)"){
				$val1=35.453*$value;
				$val2=35.453;
			}else if($value_unit=="Ar (Argon)"){
				$val1=39.0983*$value;
				$val2=39.0983;
			}else if($value_unit=="K (Potassium)"){
				$val1=39.948*$value;
				$val2=39.948;
			}else if($value_unit=="Ca (Calcium)"){
				$val1=40.08*$value;
				$val2=40.08;
			}else if($value_unit=="Sc (Scandium)"){
				$val1=44.9559*$value;
				$val2=44.9559;
			}else if($value_unit=="Ti (Titanium)"){
				$val1=47.90*$value;
				$val2=47.90;
			}else if($value_unit=="V (Vanadium)"){
				$val1=50.9415*$value;
				$val2=50.9415;
			}else if($value_unit=="Cr (Chromium)"){
				$val1=51.996*$value;
				$val2=51.996;
			}else if($value_unit=="Mn (Manganese)"){
				$val1=54.9380*$value;
				$val2=54.9380;
			}else if($value_unit=="Fe (Iron)"){
				$val1=55.847*$value;
				$val2=55.847;
			}else if($value_unit=="Co ( Cobalt)"){
				$val1=58.9332*$value;
				$val2=58.9332;
			}else if($value_unit=="Ni (Nickel)"){
				$val1=58.70*$value;
				$val2=58.70;
			}else if($value_unit=="Cu (Copper)"){
				$val1=63.546*$value;
				$val2=63.546;
			}else if($value_unit=="V (Vanadium)"){
				$val1=50.9415*$value;
				$val2=50.9415;
			}else if($value_unit=="Zn (Zinc)"){
				$val1=65.38*$value;
				$val2=65.38;
			}
			return array($val1,$val2);
		}
		if($find=="1"){//Mass Percentage
			$method=1;
			if(is_numeric($mass_solute) && is_numeric($mass_solvent)){
				$mass_solute_value=mass_convert($mass_solute_unit,$mass_solute);
				$mass_solvent_value=mass_convert($mass_solvent_unit,$mass_solvent);
				$mass_solution=$mass_solute_value+$mass_solvent_value;
				// $mass_percent=($mass_solute_value/$mass_solution)*100;
				if ($mass_solution != 0) {
					$mass_percent = ($mass_solute_value / $mass_solution) * 100;
				} else {
					$mass_percent = 0; // Default value or alternative handling
				}
				$this->param['mass_solution']=$mass_solution;
				$this->param['mass_percent']=$mass_percent;
				$this->param['method']=$method;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
			
		}else if($find=="2"){//Mass Solute
			if(is_numeric($mass_solvent) && is_numeric($mass_percentage)){
				$method=2;
				if(is_numeric($mass_solvent) && is_numeric($mass_percentage)){
					$mass_solute=$mass_solvent*$mass_percentage/100+($mass_solvent/$mass_percentage);
					$mass_solution=$mass_solvent+$mass_solute;
					$this->param['mass_solution']=$mass_solution;
					$this->param['mass_solute']=$mass_solute;
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($find=="3"){//Mass Solvent
			$method=3;
			if(is_numeric($mass_solute) && is_numeric($mass_percentage)){
				$mass_solvent=$mass_solute*100/$mass_percentage-$mass_solute;
				$mass_solution=$mass_solute+$mass_solvent;
				$this->param['mass_solution']=$mass_solution;
				$this->param['mass_solvent']=$mass_solvent;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($find=="4"){//Mass Percentage for a Chemical
			$method=4;
			if(is_numeric($mass_chemical) && is_numeric($total_mass_compound)){
				$mass_chemical_value=mass_convert($mass_chemical_unit,$mass_chemical);
				$mass_compound_value=mass_convert($total_mass_compound_unit,$total_mass_compound);
				$mass_percent=($mass_chemical_value*100)/$mass_compound_value;
			    $this->param['mass_percent']=$mass_percent;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($find=="5"){//Mass of chemical
			$method=5;
			if(is_numeric($total_mass_compound) && is_numeric($mass_percentage)){
				$mass_compound_value=mass_convert($total_mass_compound_unit,$total_mass_compound);
				$mass_of_chemical=($mass_percentage/100)*$mass_compound_value;
				$this->param['mass_of_chemical']=$mass_of_chemical;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($find=="6"){//Total Mass of Compound
			$method=6;
		// dd($mass_chemical);

			if(is_numeric($mass_chemical) && is_numeric($mass_percentage)){
				$mass_chemical_value=mass_convert($mass_chemical_unit,$mass_chemical);
				$total_mass_compound=($mass_percentage/100)*$mass_chemical_value;
				$this->param['total_mass_compound']=$total_mass_compound;
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}else if($find=="7"){
			$method=7;
			if($first_value!=""){
				if(is_numeric($first_value)){
					$value=1;
					$root=find_atomic_mass($first_value_unit,$first_value);
					$atomic_value_one=find_atomic_mass($first_value_unit,$first_value);
					$call[]=$root[0];
					$this->param['punk']=$first_value;
					$this->param['punk1']=$root[1];
					$this->param['value1']=$value;
					$this->param['name1']=$first_value_unit;
					$this->param['atomic1']=$atomic_value_one;

                    if(is_numeric($second_value) && $second_value!=""){
                        $value=2;
                        $root2=find_atomic_mass($second_value_unit,$second_value);
                        $atomic_value_two=find_atomic_mass($second_value_unit,$second_value);
                        $call[]=$root2[0];
                        $this->param['punk2']=$second_value;
                        $this->param['punk3']=$root2[1];
                        $this->param['value2']=$value;
                        $this->param['name2']=$second_value_unit;
                        $this->param['atomic2']=$atomic_value_two;
                    }
                    if(is_numeric($third_value) && $third_value!=""){
                        $value=3;
                        $root3=find_atomic_mass($third_value_unit,$third_value);
                        $atomic_value_three=find_atomic_mass($third_value_unit,$third_value);
                        $call[]=$root3[0];
                        $this->param['punk4']=$third_value;
                        $this->param['punk5']=$root3[1];
                        $this->param['value3']=$value;
                        $this->param['name3']=$third_value_unit;
                        $this->param['atomic3']=$atomic_value_three;
                    }
                    if(is_numeric($four_value) && $four_value!=""){
                        $value=4;
                        $root4=find_atomic_mass($four_value_unit,$four_value);
                        $atomic_value_four=find_atomic_mass($four_value_unit,$four_value);
                        $call[]=$root4[0];
                        $this->param['punk6']=$four_value;
                        $this->param['punk7']=$root4[1];
                        $this->param['value4']=$value;
                        $this->param['name4']=$four_value_unit;
                        $this->param['atomic4']=$atomic_value_four;
                    }
                    if(is_numeric($five_value) && $five_value!=""){
                        $value=5;
                        $root5=find_atomic_mass($five_value_unit,$five_value);
                        $atomic_value_five=find_atomic_mass($five_value_unit,$five_value);
                        $call[]=$root5[0];
                        $this->param['punk8']=$five_value;
                        $this->param['punk9']=$root5[1];
                        $this->param['value5']=$value;
                        $this->param['name5']=$five_value_unit;
                        $this->param['atomic5']=$atomic_value_five;
                    }
                    if(is_numeric($six_value) && $six_value!=""){
                        $value=6;
                        $root6=find_atomic_mass($six_value_unit,$six_value);
                        $atomic_value_six=find_atomic_mass($six_value_unit,$six_value);
                        $call[]=$root6[0];
                        $this->param['punk10']=$six_value;
                        $this->param['punk11']=$root6[1];
                        $this->param['value6']=$value;
                        $this->param['name6']=$five_value_unit;
                        $this->param['atomic6']=$atomic_value_six;
                    }
                    $total_mass=array_sum($call);
                    $this->param['call']=$total_mass;
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}
		$this->param['method']=$method;
		$this->param['RESULT'] = 1;
        return $this->param;
	}

    // Stoichiometry Calculator
	// public function stoichiometry($request){
    //     $eq=trim($request->eq);

	// 	if (preg_match("/<(?!-)|>(?!)|&(?!-)|php|print_r|print|echo|script|%/i", $eq)) {
	// 		$this->param['error'] = 'Please Enter Valid Input.';
	// 		return $this->param;
	// 	}
	// 	if (!empty($eq)) {
	// 		$format = '{
	// 			"steps": [
	// 				"<p>steps here</p>",
	// 				// continue for more steps
	// 			]
	// 		}';
	// 		$prompt = "Balance the given chemical reaction: $eq using the stoichiometry calculator. Also, Provide the following information:
	// 		The balanced equation(without steps).
	// 		The word equation for the reaction.
	// 		The type of the reaction whether it's endothermic or exothermic.
	// 		The equilibrium constant expression (Kc), if relevant.
	// 		The rate of reaction formula.
	// 		Ensure that the following data is always presented in tables:
	// 		Chemical Names and Formulas Table:
	// 		Generate a table that includes the IUPAC name, common name, and Hill formula for each substance involved in the reaction.
	// 		The table must be consistently aligned in rows and columns, and formatted correctly in KaTeX.

	// 			2. Substance Properties Table:
	// 		Generate a table with columns for each substance's molar mass, phase, melting point, boiling point, mass density, and solubility.
	// 		Ensure that each substance involved has an entry in the table and that all the values are accurate. All text lines must be in KaTeX and each line must be formatted clearly.
	// 		Note: Each step, including all the text lines, must be formatted in KateX. Don't tell me in your response that you are using KaTex. Tables must always be present and formatted correctly, with consistent alignment of rows and columns. 

	// 		";
	// 		$client = new Client();
	// 		$response = $client->post('https://api.openai.com/v1/chat/completions', [
	// 			'headers' => ['Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
	// 				'Content-Type' => 'application/json'
	// 			],
	// 			'json' => [
	// 				"model" => "gpt-4o-mini",
	// 				"response_format" => [
	// 				// "type" => "json_object"
	// 					"type" => "text"
	// 				],
	// 				"max_tokens" => 3000,
	// 				"messages" => [
	// 					[
	// 						"role" => "user",
	// 						"content" => $prompt
	// 					]
	// 				]
	// 			]
	// 		]);

	// 		$data = json_decode($response->getBody()->getContents(), true);
	// 		$dataArray = $data['choices'][0]['message']['content'];
	// 		$this->param['dataArray'] = $dataArray;
	// 		return $this->param;
	// 	}else{
	// 		$this->param['error'] = 'Please! Add at least 2 Element and its Percentage of Mass.';
	// 		return $this->param;
	// 	}

	    // if(!empty($eq)){
        //     $parem=$eq;
        //     $parem=str_replace(' ', '', $parem);
        //     $parem=str_replace('%20', '', $parem);
        //     $parem=str_replace('+', 'plus' , $parem);
        //     $parem=str_replace('{', '(', $parem);
        //     $parem=str_replace('}', ')', $parem);
        //     $parem=str_replace('e^', 'exp', $parem);
        //     $parem=str_replace('exp^', 'exp', $parem);
        //     $parem=str_replace('^', '**', $parem);
        //     $parem=str_replace('e^sqrt(x)', 'exp(2*x)', $parem);
        //     $exp=explode('=',$parem);
        //     $r=$exp[0];
        //     $p=$exp[1];
        //     $option=2;

        //     try {
		// 		$client = new Client();
		// 		$r = $client->post("http://167.172.134.148/stoichiometry", [
		// 			'form_params' => [
		// 				'r' => $r,
        //                 'p' => $p
		// 			],
		// 			'timeout' => 120,
		// 		]);
		// 		$buffer = $r->getBody();
        //         $buffer = json_decode($buffer,true);
        //         $buffer = explode('@@@', $buffer);
        //         $inp=str_replace('plus', '+', $parem);

        //         $this->param['inp'] = $inp;
        //         $this->param['be'] = $buffer[0];
        //         $this->param['mols'] = $buffer[1];
        //         $this->param['atoms'] = $buffer[2];
        //         $this->param['chemical_equation'] = $eq;
        //         $this->param['option'] = $option;
        //         $this->param['RESULT'] = 1;
        //     	return $this->param;
        //     }
        //     catch(\Exception $r) {
        //     	echo $r->getMessage();die;
        //         $this->param['error'] = 'Please enter any one value.';
        //     	return $this->param;
        //     }
        // }else{
        //     $this->param['error'] = 'Please! Check Your Input.';
        //     return $this->param;
        // } 
  	// }

	  public function stoichiometry($request){
        $eq=trim($request->eq);

	    if(preg_match("/\<|\>|\&|php|print_r|print|echo|script|&|%/i",$eq)){
            $this->param['error'] = 'Please Enter Valid Input.';
            return $this->param;
	    }

	    if(!empty($eq)){
            $parem=$eq;
            $parem=str_replace(' ', '', $parem);
            $parem=str_replace('%20', '', $parem);
            $parem=str_replace('+', 'plus' , $parem);
            $parem=str_replace('{', '(', $parem);
            $parem=str_replace('}', ')', $parem);
            $parem=str_replace('e^', 'exp', $parem);
            $parem=str_replace('exp^', 'exp', $parem);
            $parem=str_replace('^', '**', $parem);
            $parem=str_replace('e^sqrt(x)', 'exp(2*x)', $parem);
            $exp=explode('=',$parem);
            $r=$exp[0];
            $p=$exp[1];
            $option=2;

            try {
				$client = new Client();
				$r = $client->post("http://167.172.134.148/stoichiometry", [
					'form_params' => [
						'r' => $r,
                        'p' => $p
					],
					'timeout' => 120,
				]);
				$buffer = $r->getBody();
                $buffer = json_decode($buffer,true);
                $buffer = explode('@@@', $buffer);
                $inp=str_replace('plus', '+', $parem);

                $this->param['inp'] = $inp;
                $this->param['be'] = $buffer[0];
                $this->param['mols'] = $buffer[1];
                $this->param['atoms'] = $buffer[2];
                $this->param['chemical_equation'] = $eq;
                $this->param['option'] = $option;
                $this->param['RESULT'] = 1;
            	return $this->param;
            }
            catch(\Exception $r) {
            	echo $r->getMessage();die;
                $this->param['error'] = 'Please enter any one value.';
            	return $this->param;
            }
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        } 
  	}

    // Molality Calculator
    public function molality($request){
		//  dd($request->all());
        $find=$request->find;
        $amount_solute=$request->amount_solute;
        $amount_solute_unit=$request->amount_solute_unit;
        $mass_solvent=$request->mass_solvent;
        $mass_solvent_unit=$request->mass_solvent_unit;
        $molality=$request->molality;
        $molality_unit=$request->molality_unit;
        $type=$request->type;
        $density=$request->density;
        $density_unit=$request->density_unit;
        $molecular_mass_solute=$request->molecular_mass_solute;
        $molecular_mass_solute_unit=$request->molecular_mass_solute_unit;


		if($amount_solute_unit == 'mol'){
				$amount_solute_unit = 1;
		}else if($amount_solute_unit == 'mmol'){
			$amount_solute_unit = 0.001;
		}else if($amount_solute_unit == 'µmol'){
			$amount_solute_unit = 1e-6;
		}else if($amount_solute_unit == 'nmol'){
			$amount_solute_unit = 1e-9;
		}else if($amount_solute_unit == 'pmol'){
			$amount_solute_unit = 1e-12;
		}



		
		if($mass_solvent_unit == 'µg'){
				$mass_solvent_unit = 0.000000001;
		}else if($mass_solvent_unit == 'mg'){
			$mass_solvent_unit = 0.000001;
		}else if($mass_solvent_unit == 'g'){
			$mass_solvent_unit = 0.001;
		}else if($mass_solvent_unit == 'dag'){
			$mass_solvent_unit = 0.01;
		}else if($mass_solvent_unit == 'kg'){
			$mass_solvent_unit = 1;
		}else if($mass_solvent_unit == 'oz'){
			$mass_solvent_unit = 0.02835;
		}else if($mass_solvent_unit == 'lbs'){
			$mass_solvent_unit = 0.4536;
		}




		if($molality_unit == 'mol / µg'){
			$molality_unit = 0.000000001;
		}else if($molality_unit == 'mol / mg'){
			$molality_unit = 0.000001;
		}else if($molality_unit == 'mol / g'){
			$molality_unit = 0.001;
		}else if($molality_unit == 'mol / dag'){
			$molality_unit = 0.01;
		}else if($molality_unit == 'mol / kg'){
			$molality_unit = 1;
		}else if($molality_unit == 'mol / oz'){
			$molality_unit = 0.02835;
		}else if($molality_unit == 'mol / lbs'){
			$molality_unit = 0.4536;
		}


        if($type=="first"){
            if($find=="1"){//Molality
                if(is_numeric($amount_solute) && is_numeric($mass_solvent)){
                    $amount_solute_value=$amount_solute*$amount_solute_unit;
                    $mass_solvent_value=$mass_solvent*$mass_solvent_unit;
                    $calculate_molality=$amount_solute_value/$mass_solvent_value;
                    $this->param['molality']=$calculate_molality;
                    
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }else if($find=="2"){//Amount of Solute
                if(is_numeric($molality) && is_numeric($mass_solvent)){
                    $mass_solvent_value=$mass_solvent*$mass_solvent_unit;
                    $calculate_molality_value=$molality*$molality_unit;
                    $amount_of_solute=$mass_solvent_value*$calculate_molality_value;
                    $this->param['amount_of_solute']=$amount_of_solute;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }else if($find=="3"){//Mass of Solvent
                if(is_numeric($molality) && is_numeric($amount_solute)){
                    $amount_solute_value=$amount_solute*$amount_solute_unit;
                    $calculate_molality_value=$molality*$molality_unit;
                    $mass_of_solvent=$amount_solute_value/$calculate_molality_value;
                    $this->param['amount_of_solvent']=$mass_of_solvent;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
            $this->param['method']=$find;
            
        }elseif($type=="second"){//
            if(is_numeric($density) && is_numeric($molecular_mass_solute) && is_numeric($molality)){
                $density_value=$density*$density_unit;
                $molecular_mass_solute_value=$molecular_mass_solute/$molecular_mass_solute_unit;
                $calculate_molality_value=$molality*$molality_unit;
                $calculate_molarity=$density_value/((1/$calculate_molality_value)+($molecular_mass_solute_value/1000));
                $this->param['molality']=$calculate_molarity;
            }else{
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        }
        $this->param['type']=$type;
        $this->param['RESULT'] = 1;

        return $this->param;
    }

    // Mole Ratio Calculator
    public function molar_ratio($request){
		// dd($request->all());
        $find=$request->find;
        $first_coefficient=$request->first_coefficient;
        $first_product=$request->first_product;
        $moles=$request->moles;

        $z=0;
        $y=0;
        if($find=="1" || $find=="2" || $find=="3"){
            for($i=0;$i<count($first_coefficient);$i++){
                if(is_numeric($first_coefficient[$i]) && $first_coefficient[$i]>0){
                    $z=$z+1;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
            for($j=0;$j<count($first_product);$j++){
                if(is_numeric($first_product[$j]) && $first_product[$j]>0){
                    $y=$y+1;
                }else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }	
        }else if($find=="2"){
            for($k=0;$k<count($first_coefficient);$k++){
                $smith=($moles[$k]*$first_coefficient[$k+1])/$first_coefficient[$k];
            }
        }
        if($z==count($first_coefficient) && $y==count($first_product)){
            $this->param['coefficient']=$first_coefficient;
            $this->param['first_product']=$first_product;
            $this->param['RESULT'] = 1;

            return $this->param;
        }
    }

    // pKa to pH calculator
	public function pka($request){
        $buf_unit=$request->buf_unit;
        $ka=$request->ka;
        $acid=$request->acid;
        $acid_unit=$request->acid_unit;
        $salt=$request->salt;
        $salt_unit=$request->salt_unit;
        $convert=$request->convert;
        $ph=$request->ph;

		if($convert=="1"){
			if($buf_unit=="1" || $buf_unit=="2"){
				if(is_numeric($ka) && is_numeric($acid) && is_numeric($salt)){
					if($ka>0 && $acid>0 && $salt>0){
						$av=$acid*$acid_unit;
						$sv=$salt*$salt_unit;
						$pka=-log10($ka);
						if($pka=="-0"){
							$pka="0";
						}
						if($buf_unit=="1"){
							$ph=$pka-log10($av/$sv);
						}else{
							$ph=14-$pka+log10($av/$sv);
						}
						$this->param['unit']=$buf_unit;
						$this->param['pka']=$pka;
						$this->param['ph']=$ph;
						
					}else{
                        $this->param['error'] = 'Please! Enter Positive Value.';
                        return $this->param;
					}
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}	
		}else if($convert=="2"){
			if($buf_unit=="1" || $buf_unit=="2"){
				if(is_numeric($ph) && is_numeric($acid) && is_numeric($salt)){
					if($ph>0 && $acid>0 && $salt>0){
						$av=$acid*$acid_unit;
						$sv=$salt*$salt_unit;
						if($buf_unit=="1"){
							$pka=$ph+log10($av/$sv);
						}else{
							$pka=14-$ph+log10($av/$sv);
						}
						$pk=pow(10,-$pka);
						$this->param['unit']=$buf_unit;
						$this->param['pka']=$pka;
						$this->param['pk']=$pk;
					}else{
                        $this->param['error'] = 'Please! Enter Positive Value.';
                        return $this->param;
					}
				}else{
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
				}
			}	
		}
		$this->param['RESULT'] = 1;

        return $this->param;
	}

	// Calorimetry Calculator
	public function calorimetry($request){
        $type = trim($request->type);
        $state_change = trim($request->state_change);
        $obj_units = trim($request->obj_units);
        $state = trim($request->state);
        $formula = trim($request->formula);
        $three_time = trim($request->three_time);
        $energy = trim($request->energy);
        $mass = trim($request->mass);
        $heat_capacity = trim($request->heat_capacity);
        $in_temp = trim($request->in_temp);
        $s_fin_temp = trim($request->s_fin_temp);
        $temp_change = trim($request->temp_change);
        $units = trim($request->units);
        $m_units = trim($request->m_units);
        $i_t_units = trim($request->i_t_units);
        $f_t_units = trim($request->f_t_units);
        $t_c_units = trim($request->t_c_units);
        $s_heat_units = trim($request->s_heat_units);
        $subtance_mass = trim($request->subtance_mass);
        $molar_mass = trim($request->molar_mass);
        $formula_2obj = trim($request->formula_2obj);
        $formula_3obj = trim($request->formula_3obj);
        $m_units1 = trim($request->m_units1);
        $m_units2 = trim($request->m_units2);

        $s_m_units = trim($request->s_m_units);
        $S_f_t_units = trim($request->S_f_t_units);
        $m_units1_3 = trim($request->m_units1_3);
        $m_units2_3 = trim($request->m_units2_3);
        $m_units3_3 = trim($request->m_units3_3);
        $s_heat_units1_3 = trim($request->s_heat_units1_3);
        $s_heat_units2_3 = trim($request->s_heat_units2_3);
        $s_heat_units3_3 = trim($request->s_heat_units3_3);
        $i_t_units1_3 = trim($request->i_t_units1_3);
        $i_t_units2_3 = trim($request->i_t_units2_3);
        $i_t_units3_3 = trim($request->i_t_units3_3);
        $f_t_units1_3 = trim($request->f_t_units1_3);
        $f_t_units2_3 = trim($request->f_t_units2_3);
        $f_t_units3_3 = trim($request->f_t_units3_3);
        $f_t_units_3 = trim($request->f_t_units_3);
        $t_units_3 = trim($request->t_units_3);
        $h_units3 = trim($request->h_units3);

        $mass_2 = trim($request->mass_2);
        $heat_capacity_2 = trim($request->heat_capacity_2);
        $s_heat_units2 = trim($request->s_heat_units2);
        $heat_capacity_1 = trim($request->heat_capacity_1);
        $s_heat_units1 = trim($request->s_heat_units1);
        $in_temp_2 = trim($request->in_temp_2);
        $i_t_units2 = trim($request->i_t_units2);
        $fin_temp_2 = trim($request->fin_temp_2);
        $fin_temp_3 = trim($request->fin_temp_3);
        $f_t_units2 = trim($request->f_t_units2);
        $in_temp_1 = trim($request->in_temp_1);
        $i_t_units1 = trim($request->i_t_units1);
        $fin_temp_1 = trim($request->fin_temp_1);
        $f_t_units1 = trim($request->f_t_units1);
        $mass_1 = trim($request->mass_1);
        $fin_temp = trim($request->fin_temp);
        $mass_1_3 = trim($request->mass_1_3);
        $mass_2_3 = trim($request->mass_2_3);
        $mass_3_3 = trim($request->mass_3_3);
        $heat_capacity_1_3 = trim($request->heat_capacity_1_3);
        $heat_capacity_2_3 = trim($request->heat_capacity_2_3);
        $heat_capacity_3_3 = trim($request->heat_capacity_3_3);
        $in_temp_1_3 = trim($request->in_temp_1_3);
        $in_temp_2_3 = trim($request->in_temp_2_3);
        $in_temp_3_3 = trim($request->in_temp_3_3);
        $fin_temp_1_3 = trim($request->fin_temp_1_3);
        $fin_temp_2_3 = trim($request->fin_temp_2_3);
        $fin_temp_3_3 = trim($request->fin_temp_3_3);
        $fin_temp_3 = trim($request->fin_temp_3);
        $t_fusion_3 = trim($request->t_fusion_3);
        $h_fusion_3 = trim($request->h_fusion_3);
        $t_fusion = trim($request->t_fusion);
        $h_fusion = trim($request->h_fusion);
        $two_time = trim($request->two_time);

		if (!empty($state_change)) {
			if (($state_change == 'heat exchange between several objects')) {
				if ($obj_units == '2') {

					if ($state == 'No') {
						if (!empty($formula_2obj)) {
							// 2 objects data //
							if ($formula_2obj == 'm1') {
								if (
									is_numeric($mass_2) && is_numeric($heat_capacity_1) && is_numeric($heat_capacity_2)
									&& is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp_1)
									&& is_numeric($fin_temp_2)
								) {

									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units2 == 'Fahrenheit °F') {

											$in_temp_2 = $in_temp_2 / (-457.9);
										} else if ($i_t_units2 == 'celsius °C') {

											$in_temp_2 = $in_temp_2 / (-272.15);
										}
									}
									if (isset($f_t_units1)) {

										if ($f_t_units1 == 'Fahrenheit °F') {

											$fin_temp_1 = $fin_temp_1 / (-457.9);
										} else if ($f_t_units1 == 'celsius °C') {

											$fin_temp_1 = $fin_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units2)) {

										if ($f_t_units2 == 'Fahrenheit °F') {

											$fin_temp_2 = $fin_temp_2 / (-457.9);
										} else if ($f_t_units2 == 'celsius °C') {

											$fin_temp_2 = $fin_temp_2 / (-272.15);
										}
									}

									$temp_1 = $fin_temp_1 - $in_temp_1;
									$heat_1 = $heat_capacity_1 * $temp_1;
									$temp_2 = $fin_temp_2 - $in_temp_2;
									$heat_2 = $heat_capacity_2 * $temp_2;
									$mass_1 =  $mass_2 * $heat_2 / $heat_1;
									//m1 = -( m2 )c2( Tf2 - Ti2 )/c1( Tf1 - Ti1 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'c1') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2) && is_numeric($heat_capacity_2)
									&& is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp_1) && is_numeric($fin_temp_2)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units2 == 'Fahrenheit °F') {

											$in_temp_2 = $in_temp_2 / (-457.9);
										} else if ($i_t_units2 == 'celsius °C') {

											$in_temp_2 = $in_temp_2 / (-272.15);
										}
									}
									if (isset($f_t_units1)) {

										if ($f_t_units1 == 'Fahrenheit °F') {

											$fin_temp_1 = $fin_temp_1 / (-457.9);
										} else if ($f_t_units1 == 'celsius °C') {

											$fin_temp_1 = $fin_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units2)) {

										if ($f_t_units2 == 'Fahrenheit °F') {

											$fin_temp_2 = $fin_temp_2 / (-457.9);
										} else if ($f_t_units2 == 'celsius °C') {

											$fin_temp_2 = $fin_temp_2 / (-272.15);
										}
									}

									$temp_1 = $fin_temp_1 - $in_temp_1;
									$mass = $mass_1 * $temp_1;
									$temp_2 = $fin_temp_2 - $in_temp_2;
									$heat_2 = $heat_capacity_2 * $temp_2;
									$res =  - ($mass_2) * $heat_2;
									$heat_capacity_1 =  $res / $mass;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'Ti(1)') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2) && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2) && is_numeric($in_temp_2) && is_numeric($fin_temp_1) && is_numeric($fin_temp_2)
								) {
									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units2 == 'Fahrenheit °F') {

											$in_temp_2 = $in_temp_2 / (-457.9);
										} else if ($i_t_units2 == 'celsius °C') {

											$in_temp_2 = $in_temp_2 / (-272.15);
										}
									}
									if (isset($f_t_units1)) {

										if ($f_t_units1 == 'Fahrenheit °F') {

											$fin_temp_1 = $fin_temp_1 / (-457.9);
										} else if ($f_t_units1 == 'celsius °C') {

											$fin_temp_1 = $fin_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units2)) {

										if ($f_t_units2 == 'Fahrenheit °F') {

											$fin_temp_2 = $fin_temp_2 / (-457.9);
										} else if ($f_t_units2 == 'celsius °C') {

											$fin_temp_2 = $fin_temp_2 / (-272.15);
										}
									}
									$m2c2 = $mass_2 * $heat_capacity_2;
									$temp_2 = $fin_temp_2 - $in_temp_2;
									$res = $m2c2 * $temp_2;
									$res1 = $res + $fin_temp_1;
									$m1c1 = $mass_1 * $heat_capacity_1;
									$in_temp_1 = $res1 / $m1c1;
									//Ti( 1 ) = m2c2( Tf2 - Ti2 )+Tf1/m1c1;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'Tf(1)') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2) && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2) && is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp_2)
								) {
									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units2 == 'Fahrenheit °F') {

											$in_temp_2 = $in_temp_2 / (-457.9);
										} else if ($i_t_units2 == 'celsius °C') {

											$in_temp_2 = $in_temp_2 / (-272.15);
										}
									}
									if (isset($f_t_units2)) {

										if ($f_t_units2 == 'Fahrenheit °F') {

											$fin_temp_2 = $fin_temp_2 / (-457.9);
										} else if ($f_t_units2 == 'celsius °C') {

											$fin_temp_2 = $fin_temp_2 / (-272.15);
										}
									}
									$m2c2 = $mass_2 * $heat_capacity_2;
									$temp_2 = $fin_temp_2 - $in_temp_2;
									$res = $m2c2 * $temp_2;
									$res1 = $res + $in_temp_1;
									$m1c1 = $mass_1 * $heat_capacity_1;
									$fin_temp_1 =  $res1 / $m1c1;
									//Tf( 1 ) = -( m2 )c2( Tf2 - Ti2 )+Ti( 1 )/m1c1;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'm2') {
								if (
									is_numeric($mass_1) && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2) && is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp_1)
									&& is_numeric($fin_temp_2)
								) {
									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units2 == 'Fahrenheit °F') {

											$in_temp_2 = $in_temp_2 / (-457.9);
										} else if ($i_t_units2 == 'celsius °C') {

											$in_temp_2 = $in_temp_2 / (-272.15);
										}
									}
									if (isset($f_t_units1)) {

										if ($f_t_units1 == 'Fahrenheit °F') {

											$fin_temp_1 = $fin_temp_1 / (-457.9);
										} else if ($f_t_units1 == 'celsius °C') {

											$fin_temp_1 = $fin_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units2)) {

										if ($f_t_units2 == 'Fahrenheit °F') {

											$fin_temp_2 = $fin_temp_2 / (-457.9);
										} else if ($f_t_units2 == 'celsius °C') {

											$fin_temp_2 = $fin_temp_2 / (-272.15);
										}
									}

									$temp_1 = $fin_temp_1 - $in_temp_1;
									$temp_2 = $fin_temp_2 - $in_temp_2;
									$m1c1 = $mass_1 * $heat_capacity_1;
									$res = $m1c1 * $temp_1;
									$c2tf2 = $heat_capacity_2 * $temp_2;
									$mass_2 =  $res / $c2tf2;
									// m2 = -( m1 )c1( Tf1 - Ti1 )/c2( Tf( 2 )  - Ti( 2 ) );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'c2') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2) && is_numeric($heat_capacity_1)
									&& is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp_1) && is_numeric($fin_temp_2)
								) {
									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units2 == 'Fahrenheit °F') {

											$in_temp_2 = $in_temp_2 / (-457.9);
										} else if ($i_t_units2 == 'celsius °C') {

											$in_temp_2 = $in_temp_2 / (-272.15);
										}
									}
									if (isset($f_t_units1)) {

										if ($f_t_units1 == 'Fahrenheit °F') {

											$fin_temp_1 = $fin_temp_1 / (-457.9);
										} else if ($f_t_units1 == 'celsius °C') {

											$fin_temp_1 = $fin_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units2)) {

										if ($f_t_units2 == 'Fahrenheit °F') {

											$fin_temp_2 = $fin_temp_2 / (-457.9);
										} else if ($f_t_units2 == 'celsius °C') {

											$fin_temp_2 = $fin_temp_2 / (-272.15);
										}
									}
									$temp_1 = $fin_temp_1 - $in_temp_1;
									$temp_2 = $fin_temp_2 - $in_temp_2;
									$m1c1 = -$mass_1 * $heat_capacity_1;
									$res = $m1c1 * $temp_1;
									$res1 = $mass_2 * $temp_2;
									$heat_capacity_2 =  $res / $res1;
									// c2 = -( m1 )c1( Tf1 - Ti1 )/m2( Tf( 2 )  - Ti( 2 ) );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'Ti(2)') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2) && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2) && is_numeric($in_temp_1) && is_numeric($fin_temp_1) && is_numeric($fin_temp_2)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units1)) {

										if ($f_t_units1 == 'Fahrenheit °F') {

											$fin_temp_1 = $fin_temp_1 / (-457.9);
										} else if ($f_t_units1 == 'celsius °C') {

											$fin_temp_1 = $fin_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units2)) {

										if ($f_t_units2 == 'Fahrenheit °F') {

											$fin_temp_2 = $fin_temp_2 / (-457.9);
										} else if ($f_t_units2 == 'celsius °C') {

											$fin_temp_2 = $fin_temp_2 / (-272.15);
										}
									}
									$m1c1 = $mass_1 * $heat_capacity_1;
									$temp_1 = $fin_temp_1 - $in_temp_1;
									$m1c1tf1 = $m1c1 * $temp_1;
									$res = $m1c1tf1 + $fin_temp_1;
									$m2c2 = $mass_2 * $heat_capacity_1;
									$in_temp_2 =  $res / $m2c2;

									// ti2 = m1c1( Tf1 - Ti1 )+Tf2/m2c2;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'Tf(2)') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2) && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2) && is_numeric($in_temp_1) && is_numeric($fin_temp_1)
								) {
									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units2 == 'Fahrenheit °F') {

											$in_temp_2 = $in_temp_2 / (-457.9);
										} else if ($i_t_units2 == 'celsius °C') {

											$in_temp_2 = $in_temp_2 / (-272.15);
										}
									}
									if (isset($f_t_units1)) {

										if ($f_t_units1 == 'Fahrenheit °F') {

											$fin_temp_1 = $fin_temp_1 / (-457.9);
										} else if ($f_t_units1 == 'celsius °C') {

											$fin_temp_1 = $fin_temp_1 / (-272.15);
										}
									}

									$m1c1 = -$mass_1 * $heat_capacity_1;
									$temp_1 = $fin_temp_1 - $in_temp_1;
									$m1c1tf1 = $m1c1 * $temp_1;
									$res = $m1c1tf1 + $in_temp_1;
									$m2c2 = $mass_2 * $heat_capacity_2;
									$fin_temp_2 = $res / $m2c2;
									// tf2 = -m1c1( Tf1 - Ti1 )+Ti1/m2c2;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'q1') {
								if (
									is_numeric($mass_1)  && is_numeric($heat_capacity_1)
									&& is_numeric($in_temp_1) && is_numeric($fin_temp_1)
								) {
									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units1)) {

										if ($f_t_units1 == 'Fahrenheit °F') {

											$fin_temp_1 = $fin_temp_1 / (-457.9);
										} else if ($f_t_units1 == 'celsius °C') {

											$fin_temp_1 = $fin_temp_1 / (-272.15);
										}
									}

									$temp_1 = $fin_temp_1 - $in_temp_1;
									$energy =  $mass_1 * $heat_capacity_1 * $temp_1;
									// tf2 = -m1c1( Tf1 - Ti1 )+Ti1/m2c2;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_2obj == 'q2') {
								if (
									is_numeric($mass_2)  && is_numeric($heat_capacity_2)
									&& is_numeric($in_temp_2) && is_numeric($fin_temp_2)
								) {
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units2 == 'Fahrenheit °F') {

											$in_temp_2 = $in_temp_2 / (-457.9);
										} else if ($i_t_units2 == 'celsius °C') {

											$in_temp_2 = $in_temp_2 / (-272.15);
										}
									}
									if (isset($f_t_units2)) {

										if ($f_t_units2 == 'Fahrenheit °F') {

											$fin_temp_2 = $fin_temp_2 / (-457.9);
										} else if ($f_t_units2 == 'celsius °C') {

											$fin_temp_2 = $fin_temp_2 / (-272.15);
										}
									}
									$temp_2 = $fin_temp_2 - $in_temp_2;
									$energy =  $mass_2 * $heat_capacity_2 * $temp_2;
									// tf2 = -m1c1( Tf1 - Ti1 )+Ti1/m2c2;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							}
						}
					} else if ($state == 'Yes,two times') {
						if (!empty($two_time)) {
							if ($two_time == 'm1_two') {
								if (
									is_numeric($mass_2) && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2) && is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp)
									&& is_numeric($t_fusion) && is_numeric($h_fusion)
								) {
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units)) {

										if ($f_t_units == 'Fahrenheit °F') {

											$fin_temp = $fin_temp / (-457.9);
										} else if ($f_t_units == 'celsius °C') {

											$fin_temp = $fin_temp / (-272.15);
										}
									}
									if (isset($t_units)) {

										if ($t_units == 'Fahrenheit °F') {

											$t_fusion = $t_fusion / (-457.9);
										} else if ($t_units == 'celsius °C') {

											$t_fusion = $t_fusion / (-272.15);
										}
									}
									if (isset($h_fusion_unit)) {

										if ($h_fusion_unit == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion = $h_fusion / 1;
										} elseif ($h_fusion_unit == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										}
									}


									$m2c2 = $mass * $heat_capacity_2;
									$temp_2 = $fin_temp - $in_temp_2;
									$m2c2tfti2 = $m2c2 * $temp_2;
									$tfusion_ti = $t_fusion - $in_temp_1;

									$tf_tfusion = $fin_temp - $t_fusion;
									$c2_tf_tfusion = $heat_capacity_2 * $tf_tfusion;
									$c1_tfusion_ti = $heat_capacity_1 * $tfusion_ti;
									$div = $c1_tfusion_ti + $h_fusion + $c2_tf_tfusion;
									$heat_2 = $heat_capacity_2 * $temp_2;

									$mass_1 =  $m2c2tfti2 / $div;

									//m1 = -( m2 )c2( Tf - Ti2 )/c1( Tfusion - Ti1 )+Hfusion+ c2( Tf-Tfusion );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($two_time == 'c1_two') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2)
									&& is_numeric($heat_capacity_2) && is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp)
									&& is_numeric($t_fusion) && is_numeric($h_fusion)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}

									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units)) {

										if ($f_t_units == 'Fahrenheit °F') {

											$fin_temp = $fin_temp / (-457.9);
										} else if ($f_t_units == 'celsius °C') {

											$fin_temp = $fin_temp / (-272.15);
										}
									}
									if (isset($t_units)) {

										if ($t_units == 'Fahrenheit °F') {

											$t_fusion = $t_fusion / (-457.9);
										} else if ($t_units == 'celsius °C') {

											$t_fusion = $t_fusion / (-272.15);
										}
									}
									if (isset($h_fusion_unit)) {

										if ($h_fusion_unit == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion = $h_fusion / 1;
										} elseif ($h_fusion_unit == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										}
									}


									$m1Hfusion = -$mass_1 * $h_fusion;
									$tf_tfusion = $fin_temp - $t_fusion;
									$m1c2_Tf_Tfusion	 = $mass_1 * $heat_capacity_2 * $tf_tfusion;
									$tf_ti = $fin_temp - $in_temp_2;
									$m2c2_tf_ti = $mass_2 * $heat_capacity_2 * $tf_ti;
									$tfusion_ti = $t_fusion - $in_temp_1;
									$m1_tfusion_ti = $mass_1 * $tfusion_ti;

									$res = $m1Hfusion - $m1c2_Tf_Tfusion - $m2c2_tf_ti;

									$heat_capacity_1 = $res / $m1_tfusion_ti;
									//heat_capacity_1 = -( m1 )Hfusion-m1c2( Tf - Tfusion )-m2c2( Tf - Ti2 )/m1( Tfusion - Ti1 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($two_time == 'Ti(1)') {

								if (
									is_numeric($mass_1) && is_numeric($mass_2)  && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2)  && is_numeric($in_temp_2) && is_numeric($fin_temp)
									&& is_numeric($t_fusion) && is_numeric($h_fusion)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}

									if (isset($i_t_units2)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units)) {

										if ($f_t_units == 'Fahrenheit °F') {

											$fin_temp = $fin_temp / (-457.9);
										} else if ($f_t_units == 'celsius °C') {

											$fin_temp = $fin_temp / (-272.15);
										}
									}
									if (isset($t_units)) {

										if ($t_units == 'Fahrenheit °F') {

											$t_fusion = $t_fusion / (-457.9);
										} else if ($t_units == 'celsius °C') {

											$t_fusion = $t_fusion / (-272.15);
										}
									}
									if (isset($h_fusion_unit)) {

										if ($h_fusion_unit == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion = $h_fusion / 1;
										} elseif ($h_fusion_unit == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										}
									}
									$m1Hfusion = -$mass_1 * $h_fusion;
									$tf_tfusion = $fin_temp - $t_fusion;
									$m1c2_Tf_Tfusion	 = $mass_1 * $heat_capacity_2 * $tf_tfusion;
									$tf_ti = $fin_temp - $in_temp_2;
									$m2c2_tf_ti = $mass_2 * $heat_capacity_2 * $tf_ti;

									$m1_c1 = $mass_1 * $heat_capacity_1;

									$res = $m1Hfusion - $m1c2_Tf_Tfusion - $m2c2_tf_ti;

									$in_temp_1 = $res / $m1_c1;
									//in_temp_1 = -( m1 )Hfusion-m1c2( Tf - Tfusion )-m2c2( Tf - Ti2 )/m1c1;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($two_time == 'Tfusion') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2)  && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2)  && is_numeric($in_temp_2) && is_numeric($fin_temp)
									&& is_numeric($h_fusion)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}

									if (isset($i_t_units2)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units)) {

										if ($f_t_units == 'Fahrenheit °F') {

											$fin_temp = $fin_temp / (-457.9);
										} else if ($f_t_units == 'celsius °C') {

											$fin_temp = $fin_temp / (-272.15);
										}
									}

									if (isset($h_fusion_unit)) {

										if ($h_fusion_unit == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion = $h_fusion / 1;
										} elseif ($h_fusion_unit == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										}
									}
									$m1Hfusion = -$mass_1 * $h_fusion;
									$tf_ti = $fin_temp - $in_temp_1;
									$m2c2_tf_ti = $mass_2 * $heat_capacity_2 * $tf_ti;
									$m1c1Ti	 = $mass_1 * $heat_capacity_1 * $in_temp_1;
									$m1c2Tf	 = $mass_1 * $heat_capacity_2 * $fin_temp;
									$m1c1 = $mass_1 * $heat_capacity_1;
									$m1c2 = $mass_1 * $heat_capacity_2;

									$res = $m1Hfusion - $m2c2_tf_ti - $m1c1Ti - $m1c2Tf;
									$m1c1_m1c2 = $m1c1 - $m1c2;
									$t_fusion = $res / $m1c1_m1c2;
									//t_fusion = -( m1 )Hfusion-m2c2( Tf - Ti1 )-m1c1Ti-m1c2Tf/m1c1-m1c2;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($two_time == 'ΔHfusion') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2)  && is_numeric($heat_capacity_1)
									&& is_numeric($heat_capacity_2)  && is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp)
									&& is_numeric($t_fusion)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units)) {

										if ($f_t_units == 'Fahrenheit °F') {

											$fin_temp = $fin_temp / (-457.9);
										} else if ($f_t_units == 'celsius °C') {

											$fin_temp = $fin_temp / (-272.15);
										}
									}
									if (isset($t_units)) {

										if ($t_units == 'Fahrenheit °F') {

											$t_fusion = $t_fusion / (-457.9);
										} else if ($t_units == 'celsius °C') {

											$t_fusion = $t_fusion / (-272.15);
										}
									}

									$Tfusion_ti = $t_fusion - $in_temp_1;
									$m1_c1 = (-$mass_1) * $heat_capacity_1;
									$m1_c1_tfusion_ti = $m1_c1 * $Tfusion_ti;
									$tf_tfusion = $fin_temp - $t_fusion;
									$m1c2 = $mass_1 * $heat_capacity_2;
									$m1c2_tf_tfusion = $m1c2 * $tf_tfusion;
									$tf_ti = $fin_temp - $in_temp_2;
									$m2c2 = $mass_2 * $heat_capacity_2;
									$m2c2_tf_ti = $m2c2 * $tf_ti;

									$res = $m1_c1_tfusion_ti - $m1c2_tf_tfusion - $m2c2_tf_ti;
									$h_fusion = $res / $mass_1;

									//h_fusion = ( -m1 )c1( Tfusion-Ti1 ) -m1c2( Tf - Tfusion )-m2c2( Tf-Ti2 )/m1;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($two_time == 'c2') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2)  && is_numeric($heat_capacity_1)
									&& is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp)
									&& is_numeric($h_fusion) && is_numeric($t_fusion)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}

									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units)) {

										if ($f_t_units == 'Fahrenheit °F') {

											$fin_temp = $fin_temp / (-457.9);
										} else if ($f_t_units == 'celsius °C') {

											$fin_temp = $fin_temp / (-272.15);
										}
									}
									if (isset($t_units)) {

										if ($t_units == 'Fahrenheit °F') {

											$t_fusion = $t_fusion / (-457.9);
										} else if ($t_units == 'celsius °C') {

											$t_fusion = $t_fusion / (-272.15);
										}
									}
									if (isset($h_fusion_unit)) {

										if ($h_fusion_unit == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion = $h_fusion / 1;
										} elseif ($h_fusion_unit == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										}
									}

									$Tfusion_ti = $t_fusion - $in_temp_1;
									$m1_c1 = (-$mass_1) * $heat_capacity_1;
									$m1_c1_tfusion_ti = $m1_c1 * $Tfusion_ti;
									$m1hfusion  = $mass_1 * $h_fusion;
									$tf_tfusion = $fin_temp - $t_fusion;
									$m1_tf_tfusion = $mass_1 * $tf_tfusion;
									$m1hfusion_m1_tf_tfusion = $m1hfusion;
									$tf_ti = $fin_temp - $in_temp_2;

									$m2_tf_ti = $mass_2 * $tf_ti;

									$res = $m1_c1_tfusion_ti - $m1hfusion;
									$res1 = $m1_tf_tfusion + $m2_tf_ti;
									$heat_capacity_2 = $res / $res1;

									//heat_capacity_2 = ( -m1 )c1( Tfusion-Ti1 ) -m1hfusion/m1( Tf - Tfusion )+m2( Tf-Ti2 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($two_time == 'm2') {
								if (
									is_numeric($mass_1)   && is_numeric($heat_capacity_1) && is_numeric($heat_capacity_2)
									&& is_numeric($in_temp_1) && is_numeric($in_temp_2) && is_numeric($fin_temp)
									&& is_numeric($h_fusion) && is_numeric($t_fusion)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}

									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($f_t_units)) {

										if ($f_t_units == 'Fahrenheit °F') {

											$fin_temp = $fin_temp / (-457.9);
										} else if ($f_t_units == 'celsius °C') {

											$fin_temp = $fin_temp / (-272.15);
										}
									}
									if (isset($t_units)) {

										if ($t_units == 'Fahrenheit °F') {

											$t_fusion = $t_fusion / (-457.9);
										} else if ($t_units == 'celsius °C') {

											$t_fusion = $t_fusion / (-272.15);
										}
									}
									if (isset($h_fusion_unit)) {

										if ($h_fusion_unit == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion = $h_fusion / 1;
										} elseif ($h_fusion_unit == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										}
									}
									$m1_c1 = (-$mass_1) * $heat_capacity_1;
									$Tfusion_ti = $t_fusion - $in_temp_1;
									$m1_c1_tfusion_ti = $m1_c1 * $Tfusion_ti;
									$m1hfusion  = $mass_1 * $h_fusion;
									$tf_tfusion = $fin_temp - $t_fusion;

									$m1_c2_tf_tfusion = $mass_1 * $heat_capacity_2 * $tf_tfusion;
									// $m1hfusion_m1_c2_tf_tfusion = $m1hfusion-$mass_1*$heat_capacity_2*$tf_tfusion;
									$tf_ti = $fin_temp - $in_temp_2;
									$c2_tf_ti = $heat_capacity_2 * $tf_ti;

									$res = $m1_c1_tfusion_ti - $m1hfusion - $m1_c2_tf_tfusion;
									$mass_2 = $res / $c2_tf_ti;

									//heat_capacity_2 = ( -m1 )c1( Tfusion-Ti1 )-m1hfusion-m1c2( Tf - Tfusion )/c2( Tf-Ti2 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($two_time == 'Ti(2)') {

								if (
									is_numeric($mass_1) && is_numeric($mass_2)  && is_numeric($heat_capacity_1) && is_numeric($heat_capacity_2)
									&& is_numeric($in_temp_1) && is_numeric($fin_temp)
									&& is_numeric($h_fusion) && is_numeric($t_fusion)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}

									if (isset($f_t_units)) {

										if ($f_t_units == 'Fahrenheit °F') {

											$fin_temp = $fin_temp / (-457.9);
										} else if ($f_t_units == 'celsius °C') {

											$fin_temp = $fin_temp / (-272.15);
										}
									}
									if (isset($t_units)) {

										if ($t_units == 'Fahrenheit °F') {

											$t_fusion = $t_fusion / (-457.9);
										} else if ($t_units == 'celsius °C') {

											$t_fusion = $t_fusion / (-272.15);
										}
									}
									if (isset($h_fusion_unit)) {

										if ($h_fusion_unit == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion = $h_fusion / 1;
										} elseif ($h_fusion_unit == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										}
									}
									$m1_h1 = -$mass_1 * $heat_capacity_1;
									$tfusion_in_temp = $t_fusion - $in_temp_1;
									$m1_h1_tfusion_intemp = $m1_h1 * $tfusion_in_temp;

									$m1hfusion = $mass_1 * $h_fusion;
									$tf_tfusion = $fin_temp - $t_fusion;
									$m1c2_tf_tfusion = $mass_1 * $heat_capacity_2 * $tf_tfusion;
									$m2c2 = $mass_2 * $heat_capacity_2;

									$res = 	$m1_h1_tfusion_intemp - $m1hfusion - $m1c2_tf_tfusion - $fin_temp;
									$res_1 = $res / $m2c2;

									$in_temp_2 = $res_1;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($two_time == 'Tf') {
								if (
									is_numeric($mass_1) && is_numeric($mass_2)  && is_numeric($heat_capacity_1) && is_numeric($heat_capacity_2)
									&& is_numeric($in_temp_1) && is_numeric($in_temp_2)
									&& is_numeric($h_fusion) && is_numeric($t_fusion)
								) {

									if (isset($m_units1)) {

										if ($m_units1 == 'picograms (pg)') {

											$mass_1 = $mass_1 / 1000000000000;
										} else if ($m_units1 == 'nanograms (ng)') {

											$mass_1 = $mass_1 / 1000000000;
										} else if ($m_units1 == 'micrograms (μg)') {

											$mass_1 = $mass_1 / 1000000;
										} else if ($m_units1 == 'milligrams (mg)') {

											$mass_1 = $mass_1 / 1000;
										} else if ($m_units1 == 'decagrams (dag)') {

											$mass_1 = $mass_1 / 0.1;
										} else if ($m_units1 == 'kilograms (kg)') {

											$mass_1 = $mass_1 / 0.001;
										} else if ($m_units1 == 'metric tons (t)') {

											$mass_1 = $mass_1 / 0.000001;
										} else if ($m_units1 == 'grains (gr)') {

											$mass_1 = $mass_1 / 15.432;
										} else if ($m_units1 == 'drachms (dr)') {

											$mass_1 = $mass_1 / 0.5644;
										} else if ($m_units1 == 'ounces (oz)') {

											$mass_1 = $mass_1 / 0.035274;
										} else if ($m_units1 == 'pounds (lb)') {

											$mass_1 = $mass_1 / 0.0022046;
										} else if ($m_units1 == 'stones (stone)') {

											$mass_1 = $mass_1 / 0.00015747;
										} else if ($m_units1 == 'US short tones (US ton)') {

											$mass_1 = $mass_1 / 0.0000011023;
										} else if ($m_units1 == 'imperial tons (Long ton)') {

											$mass_1 = $mass_1 / 0.0000009842;
										} else if ($m_units1 == 'atomic mass_2 unit (u)') {

											$mass_1 = $mass_1 / 602214000000000000000000;
										} else if ($m_units1 == 'troy ounce (oz t)') {

											$mass_1 = $mass_1 / 0.03215;
										}
									}
									if (isset($m_units2)) {

										if ($m_units2 == 'picograms (pg)') {

											$mass_2 = $mass_2 / 1000000000000;
										} else if ($m_units2 == 'nanograms (ng)') {

											$mass_2 = $mass_2 / 1000000000;
										} else if ($m_units2 == 'micrograms (μg)') {

											$mass_2 = $mass_2 / 1000000;
										} else if ($m_units2 == 'milligrams (mg)') {

											$mass_2 = $mass_2 / 1000;
										} else if ($m_units2 == 'decagrams (dag)') {

											$mass_2 = $mass_2 / 0.1;
										} else if ($m_units2 == 'kilograms (kg)') {

											$mass_2 = $mass_2 / 0.001;
										} else if ($m_units2 == 'metric tons (t)') {

											$mass_2 = $mass_2 / 0.000001;
										} else if ($m_units2 == 'grains (gr)') {

											$mass_2 = $mass_2 / 15.432;
										} else if ($m_units2 == 'drachms (dr)') {

											$mass_2 = $mass_2 / 0.5644;
										} else if ($m_units2 == 'ounces (oz)') {

											$mass_2 = $mass_2 / 0.035274;
										} else if ($m_units2 == 'pounds (lb)') {

											$mass_2 = $mass_2 / 0.0022046;
										} else if ($m_units2 == 'stones (stone)') {

											$mass_2 = $mass_2 / 0.00015747;
										} else if ($m_units2 == 'US short tones (US ton)') {

											$mass_2 = $mass_2 / 0.0000011023;
										} else if ($m_units2 == 'imperial tons (Long ton)') {

											$mass_2 = $mass_2 / 0.0000009842;
										} else if ($m_units2 == 'atomic mass_2 unit (u)') {

											$mass_2 = $mass_2 / 602214000000000000000000;
										} else if ($m_units2 == 'troy ounce (oz t)') {

											$mass_2 = $mass_2 / 0.03215;
										}
									}
									if (isset($s_heat_units1)) {

										if ($s_heat_units1 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1000;
										} elseif ($s_heat_units1 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 1;
										} elseif ($s_heat_units1 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 238.9;
										} elseif ($s_heat_units1 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										} elseif ($s_heat_units1 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1 = $heat_capacity_1 / 0.2389;
										}
									}
									if (isset($s_heat_units2)) {

										if ($s_heat_units2 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1000;
										} elseif ($s_heat_units2 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 1;
										} elseif ($s_heat_units2 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 238.9;
										} elseif ($s_heat_units2 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										} elseif ($s_heat_units2 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2 = $heat_capacity_2 / 0.2389;
										}
									}
									if (isset($i_t_units1)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($i_t_units2)) {

										if ($i_t_units1 == 'Fahrenheit °F') {

											$in_temp_1 = $in_temp_1 / (-457.9);
										} else if ($i_t_units1 == 'celsius °C') {

											$in_temp_1 = $in_temp_1 / (-272.15);
										}
									}
									if (isset($t_units)) {

										if ($t_units == 'Fahrenheit °F') {

											$t_fusion = $t_fusion / (-457.9);
										} else if ($t_units == 'celsius °C') {

											$t_fusion = $t_fusion / (-272.15);
										}
									}
									if (isset($h_fusion_unit)) {

										if ($h_fusion_unit == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion = $h_fusion / 1000;
										} elseif ($h_fusion_unit == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion = $h_fusion / 1;
										} elseif ($h_fusion_unit == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion = $h_fusion / 238.9;
										} elseif ($h_fusion_unit == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										} elseif ($h_fusion_unit == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion = $h_fusion / 0.2389;
										}
									}
									$tfusion_ti	 = $t_fusion - $in_temp_1;
									$m1c1tfti	 = $mass_1 * $heat_capacity_1 * $tfusion_ti;
									$m1Hfusion = $mass_1 * $h_fusion;
									$m1c1Tfusion = $mass_1 * $heat_capacity_1 * $t_fusion;
									$m2c2Ti2 = $mass_2 * $heat_capacity_2 * $in_temp_2;
									$m1c2 = $mass_1 * $heat_capacity_2;
									$m2c2 = $mass_2 * $heat_capacity_2;
									$divide = -$m1c2 - $m2c2;

									$res = $m1c1tfti + $m1Hfusion - $m1c1Tfusion - $m2c2Ti2;
									$fin_temp = $res / $divide;

									// Tf = m1c1( Tfusion - Ti1 )+m1Hfusion-m1c1Tfusion-m2c2Ti2/-m1c2-m2c2;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							}
						}
					}
				}
				if ($obj_units == '3') {
					if ($state == 'No') {
						if (!empty($formula_3obj)) {

							if ($formula_3obj == 'm1') {
								if (
									is_numeric($mass_2_3) && is_numeric($mass_3_3) && is_numeric($heat_capacity_1_3)
									&& is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3) && is_numeric($in_temp_1_3)
									&& is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3) && is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3)
									&& is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}
									if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									}
									if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									}
									if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$tf_ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2;
									$m2c2tf2ti2 = $m2c2 * $tf_ti2;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;
									$m3c3_tf_ti3 = $m3c3 * $tf_ti3;

									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$c1_tf_ti1 = $heat_capacity_1_3 * $tf_ti1;

									$res = $m2c2tf2ti2 - $m3c3_tf_ti3;
									$mass_1_3 = $res / $c1_tf_ti1;

									//m1 = -( m2 )c2( Tf2 - Ti2 )-m3c3( Tf3 - Ti3 )/c1( Tf1 - Ti1 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'c1') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3) && is_numeric($in_temp_1_3)
									&& is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3) && is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3)
									&& is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									} elseif (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									} else if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									} else if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									} else if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									} else if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									} else if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									} else if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									} else if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									} else if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									} else if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$tf_ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$m2c2 = -$mass_2_3 * $heat_capacity_2_3;
									$m2c2tf2ti2 = $m2c2 * $tf_ti2;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;
									$m3c3_tf_ti3 = $m3c3 * $tf_ti3;


									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m1_tf_ti1 = $mass_1_3 * $tf_ti1;

									$res = $m2c2tf2ti2 - $m3c3_tf_ti3;
									$heat_capacity_1_3 = $res / $m1_tf_ti1;

									//m1 = -( m2 )c2( Tf2 - Ti2 )-m3c3( Tf3 - Ti3 )/m1( Tf1 - Ti1 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'Tf(1)') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_2_3) && is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									} elseif (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									} else if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									} else if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									} else if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									} else if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									} else if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									} else if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									} else if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									} else if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									} else if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$tf_ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$m2c2 = -$mass_2_3 * $heat_capacity_2_3;
									$m2c2tf2ti2 = $m2c2 * $tf_ti2;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;
									$m3c3_tf_ti3 = $m3c3 * $tf_ti3;
									$m3c3_tf_ti3_ti	 = $m3c3_tf_ti3 + $in_temp_1_3;
									$m1c1 = $mass_1_3 * $heat_capacity_1_3;

									$res = $m2c2tf2ti2 - $m3c3_tf_ti3_ti;
									$fin_temp_1_3 = $res / $m1c1;


									//m1 = -( m2 )c2( Tf2 - Ti2 )-m3c3( Tf3 - Ti3 )+Ti( 1 )/m1c1;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'Ti(1)') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_2_3)  && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3) && is_numeric($fin_temp_3_3)
								) {


									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									} elseif (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									} else if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									} else if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									} else if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									} else if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									} else if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									} else if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									} else if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									} else if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									} else if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$tf_ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$m2c2tf2ti2 = $m2c2 * $tf_ti2;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;
									$m3c3_tf_ti3 = $m3c3 * $tf_ti3;
									$m3c3_tf_ti3_ti	 = $m3c3_tf_ti3 + $fin_temp_1;
									$m1c1 = $mass_1_3 * $heat_capacity_1_3;

									$res1 = $m2c2tf2ti2 - $m3c3_tf_ti3;
									$res = $res1 + $fin_temp_1_3;

									$in_temp_1_3 = $res / $m1c1;

									//t1 = m2c2( Tf2 - Ti2 )-m3c3( Tf3 - Ti3 )+Tf( 1 )/m1c1;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'm2') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3)  && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3) && is_numeric($fin_temp_3_3)
								) {


									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									} else if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									} else if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									} else if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									} else if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									} else if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									} else if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									} else if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									} else if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									} else if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									} else if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m1c1 = $mass_1_3 * $heat_capacity_1_3;
									$m1c1tf1ti1 = $m1c1 * $tf_ti1;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;
									$m3c3_tf_ti3 = $m3c3 * $tf_ti3;
									$tf2ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$c2tf2ti2 = $heat_capacity_2_3 * $tf2ti2;

									$res	 = $m1c1tf1ti1 - $m3c3_tf_ti3;

									$mass_2_3 = $res / $c2tf2ti2;



									//t1 = -m1c1( Tf1 - Ti1 )-m3c3( Tf3 - Ti3 )/c2( Tf2 - Ti2 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'c2') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3)  && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3) && is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}

									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}
									if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									}
									if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									}
									if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$m1c1tf1ti1 = $m1c1 * $tf_ti1;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;
									$m3c3_tf_ti3 = $m3c3 * $tf_ti3;
									$tf2ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$m2tf2ti2 = $mass_2_3 * $tf2ti2;

									$res	 = $m1c1tf1ti1 - $m3c3_tf_ti3;

									$heat_capacity_2_3 = $res / $m2tf2ti2;


									//t1 = -m1c1( Tf1 - Ti1 )-m3c3( Tf3 - Ti3 )/m2( Tf2 - Ti2 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'Tf(2)') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3)  && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}
									if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									}

									if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$m1c1tf1ti1 = $m1c1 * $tf_ti1;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;
									$m3c3_tf_ti3 = $m3c3 * $tf_ti3;
									$m3c3_tf_ti3_ti2 = $m3c3_tf_ti3 + $in_temp_2;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;

									$res = $m1c1tf1ti1 - $m3c3_tf_ti3 + $in_temp_2_3;

									$fin_temp_2_3 = $res / $m2c2;



									//t1 = -m1c1( Tf1 - Ti1 )-m3c3( Tf3 - Ti3 )+Ti( 2 )/m2c2;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'Ti(2)') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3)  && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3) && is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}

									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}
									if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									}
									if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									}
									if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$m1c1 = $mass_1_3 * $heat_capacity_1_3;
									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m1c1tf1ti1 = $m1c1 * $tf_ti1;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;
									$m3c3_tf_ti3 = $m3c3 * $tf_ti3;
									$m3c3_tf_ti3_tf2 = $m3c3_tf_ti3 + $fin_temp_2_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;

									$res = $m1c1tf1ti1 + $m3c3_tf_ti3_tf2;
									$in_temp_2_3 = $res / $m2c2;


									//t1 = m1c1( Tf1 - Ti1 )+m3c3( Tf3 - Ti3 )+Tf( 2 )/m2c2;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'm3') {

								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3)  && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3) && is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}

									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}
									if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									}
									if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									}
									if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$m1c1 = $mass_1_3 * $heat_capacity_1_3;
									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;

									$m1c1tf1ti1 = $m1c1 * $tf_ti1;
									$m2c2tf2ti2 = $m2c2 * $tf_ti2;
									$c3tf3ti3 = $heat_capacity_3_3 * $tf_ti3;

									$res = $m1c1tf1ti1 - $m2c2tf2ti2;
									$mass_3_3 = $res / $c3tf3ti3;
									// 	//c1 = -m1c1( Tf1 - Ti1 )-m2c2( Tf2 - Ti2 )/c3( Tf( 3 ) - Ti( 3 ) ) );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'c3') {

								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3)
									&& is_numeric($in_temp_1_3)  && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3) && is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}

									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									} else if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									}
									if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									}
									if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$tf_ti3 = $fin_temp_3_3 - $in_temp_3_3;

									$m1c1tf1ti1 = $m1c1 * $tf_ti1;
									$m2c2tf2ti2 = $m2c2 * $tf_ti2;
									$m3tf3ti3 = $mass_3_3 * $tf_ti3;

									$res = $m1c1tf1ti1 - $m2c2tf2ti2;
									$heat_capacity_3_3 = $res / $m3tf3ti3;

									// 	//c1 = -m1c1( Tf1 - Ti1 )-m2c2( Tf2 - Ti2 )/m3( Tf( 3 - Ti( 3 ) ) );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'Tf(3)') {

								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3)  && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}
									if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									}
									if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									}



									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$m3c3 =  $mass_3_3 * $heat_capacity_3_3;

									$m1c1tf1ti1 = $m1c1 * $tf_ti1;
									$m2c2tf2ti2 = $m2c2 * $tf_ti2;
									$m2c2tf2ti2ti3 = $m2c2tf2ti2 + $in_temp_3_3;

									$res = $m1c1tf1ti1 - $m2c2tf2ti2ti3;
									$fin_temp_3_3 = $res / $m3c3;

									// 	//c1 = -m1c1( Tf1 - Ti1 )-m2c2( Tf2 - Ti2 )+Ti( 3 )/m3c3;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} elseif ($formula_3obj == 'Ti(3)') {

								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3)  && is_numeric($in_temp_2_3)
									&& is_numeric($fin_temp_1_3) && is_numeric($fin_temp_2_3) && is_numeric($fin_temp_3_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}

									if (isset($f_t_units1_3)) {

										if ($f_t_units1_3 == 'Fahrenheit °F') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-457.9);
										} else if ($f_t_units1_3 == 'celsius °C') {

											$fin_temp_1_3 = $fin_temp_1_3 / (-272.15);
										}
									}
									if (isset($f_t_units2_3)) {

										if ($f_t_units2_3 == 'Fahrenheit °F') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-457.9);
										} else if ($f_t_units2_3 == 'celsius °C') {

											$fin_temp_2_3 = $fin_temp_2_3 / (-272.15);
										}
									}
									if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}

									$m1c1 = $mass_1_3 * $heat_capacity_1_3;
									$tf_ti1 = $fin_temp_1_3 - $in_temp_1_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_2_3 - $in_temp_2_3;
									$m3c3 =  $mass_3_3 * $heat_capacity_3_3;

									$m1c1tf1ti1 = $m1c1 * $tf_ti1;
									$m2c2tf2ti2 = $m2c2 * $tf_ti2;
									$m2c2tf2ti2ti3 = $m2c2tf2ti2 + $fin_temp_3_3;

									$res = $m1c1tf1ti1 + $m2c2tf2ti2ti3;
									$in_temp_3_3 = $res / $m3c3;

									// 	//c1 = m1c1( Tf1 - Ti1 )+m2c2( Tf2 - Ti2 )+Tf( 3 )/m3c3;
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							}
						}
					} elseif ($state == 'Yes,two times') {
						if (!empty($three_time)) {

							if ($three_time == 'm1') {
								if (
									is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3_3) && is_numeric($fin_temp_3) && is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {

									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}
									if (isset($f_t_units3_3)) {

										if ($f_t_units3_3 == 'Fahrenheit °F') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-457.9);
										} else if ($f_t_units3_3 == 'celsius °C') {

											$fin_temp_3_3 = $fin_temp_3_3 / (-272.15);
										}
									}
									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}
									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}

									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;
									$m2c2tfti2 = $m2c2 * $tf_ti2;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3 - $in_temp_3_3;
									$m3c3tfti3 = $m3c3 * $tf_ti3;

									$tfusion_ti = $t_fusion_3 - $in_temp_1_3;
									$c1_tfusion_ti = $heat_capacity_1_3 * $tfusion_ti;

									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$c2_tf_tfusion = $heat_capacity_2_3 * $tf_tfusion;

									$m2c2tf2ti2_m3c3tfti3 = $m2c2tfti2 - $m3c3tfti3;
									$c1tfusionti1_hfusion_c2tftfusion = $c1_tfusion_ti + $h_fusion_3 + $c2_tf_tfusion;
									$mass_1_3 = $m2c2tf2ti2_m3c3tfti3 / $c1tfusionti1_hfusion_c2tftfusion;

									//m1 = -( m2 )c2( Tf - Ti2 )-m3c3( Tf - Ti3 )/c1( Tfusion - Ti1 )+ Hfusion + c2( Tf - Tfusion );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'c1') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}

									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}

									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}
									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}


									$m1hfusion = -$mass_1_3 * $h_fusion_3;
									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$m1c2tftfuion = $mass_1_3 * $heat_capacity_2_3 * $tf_tfusion;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;
									$m2c2tfti2 = $m2c2 * $tf_ti2;
									$tf_ti3 = $fin_temp_3 - $in_temp_3_3;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$m3c3tfti3 = $m3c3 * $tf_ti3;
									$tfusion_ti1 = $t_fusion_3 - $in_temp_1_3;
									$m1tfusionti1 = $mass_1_3 * $tfusion_ti1;

									$res = $m1hfusion + $m1c2tftfuion + $m2c2tfti2 + $m3c3tfti3;
									$heat_capacity_1_3 = $res / $m1tfusionti1;

									//m1 = -( m1 )hfusion+m1c2( Tf - Tfusion )+m2c2( Tf - Ti2 )+m3c3( Tf-Ti3 )/m1( Tfusion - Ti1 );
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'Tfusion') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($h_fusion_3)
								) {


									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}

									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}

									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;
									$m2c2tfti2 = $m2c2 * $tf_ti2;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3 - $in_temp_3_3;
									$m3c3tfti3 = $m3c3 * $tf_ti3;
									$m1hfusion = $mass_1_3 * $h_fusion_3;
									$m1c1ti1 = $mass_1_3 * $heat_capacity_1_3 * $in_temp_1_3;
									$m1c2tf = $mass_1_3 * $heat_capacity_2_3 * $fin_temp_3;

									$m1c1 = $mass_1_3 * $heat_capacity_1_3;
									$m1c2 = $mass_1_3 * $heat_capacity_2_3;

									$div = 	$m1c1 - $m1c2;
									$res = $m2c2tfti2 + $m3c3tfti3 - $m1hfusion + $m1c1ti1 - $m1c2tf;
									$t_fusion_3 = $res / $div;

									//m1 = m2c2( Tf - Ti2 )+m3c3( Tf - Ti3 )-m1hfusion+m1c1Ti1-m2c2Tf/m1c1-m1c2
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'Ti(1)') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {


									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}

									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}

									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}


									$m1hfusion = -$mass_1_3 * $h_fusion_3;
									$m1c2 = $mass_1_3 * $heat_capacity_2_3;
									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$m1c2tftfuion = $m1c2 * $tf_tfusion;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;
									$m2c2tfti2 = $m2c2 * $tf_ti2;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3 - $in_temp_3_3;
									$m3c3tfti3 = $m3c3 * $tf_ti3;
									$m1c1tfusion = $mass_1_3 * $heat_capacity_1_3 * $h_fusion_3;
									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;

									$res = $m1hfusion - $m1c2tftfuion + $m2c2tfti2 + $m3c3tfti3 - $m1c1tfusion;
									$in_temp_1_3 = $res / $m1c1;

									//m1 = -m1hfusion-m1c2( Tf - Tfusion )+m2c2( Tf - Ti2 )+m3c3( Tf - Ti( 3 ) )-m1c1Tfussion/-m1c1
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'Hfusion') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($t_fusion_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}

									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tfusionti1 = $t_fusion_3 - $in_temp_1_3;
									$m1c2 = $mass_1_3 * $heat_capacity_2_3;
									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3 - $in_temp_3_3;

									$m1c1tfusionti1 = $m1c1 * $tfusionti1;
									$m1c2tftfusion = $m2c2 * $tf_tfusion;
									$m2c2tfti2 = $m2c2 * $tf_ti2;
									$m3c3tfti3 = $m3c3 * $tf_ti3;

									$res = $m1c1tfusionti1 - $m1c2tftfusion - $m2c2tfti2 + $m3c3tfti3 - $m3c3tfti3;
									$h_fusion_3 = $res / $mass_1_3;

									//m1 = -m1c1( Tfusion - Ti( 1 ) )-m1c2( Tf - Tfusion )-m2c2( Tf - Ti( 2 ) )-m3c3( Tf - Ti( 3 ) )/m1
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'c2') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {


									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}

									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}
									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}

									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tfusionti1 = $t_fusion_3 - $in_temp_1_3;
									$m1c1tfusionti1 = $m1c1 * $tfusionti1;
									$m1hfusion = $mass_1_3 * $h_fusion_3;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3 - $in_temp_3_3;
									$m3c3tfti3 = $m3c3 * $tf_ti3;
									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$m1tftfusion = $mass_1_3 * $tf_tfusion;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;
									$m2tfti2 = $mass_2_3 * $tf_ti2;

									$res = $m1c1tfusionti1 - $m1hfusion - $m3c3tfti3;
									$div = $m1tftfusion + $m2tfti2;
									$heat_capacity_2_3 = $res / $div;

									//m1 = -m1c1( Tfusion - Ti( 1 ) )-m1hfusion-m3c3( Tf - Ti( 3 ) )/m1( Tf - Tfusion )+m2( Tf - Ti2 )
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'm2') {
								if (
									is_numeric($mass_1_3)  && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}

									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}
									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}

									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tfusionti1 = $t_fusion_3 - $in_temp_1_3;
									$m1c1tfusionti1 = $m1c1 * $tfusionti1;
									$m1hfusion = $mass_1_3 * $h_fusion_3;

									$m1c2 = $mass_1_3 * $heat_capacity_2_3;
									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$m1c2tftfuion = $m1c2 * $tf_tfusion;

									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3 - $in_temp_3_3;
									$m3c3tfti3 = $m3c3 * $tf_ti3;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;

									$c2tfti2 = $heat_capacity_2_3 * $tf_ti2;

									$res = $m1c1tfusionti1 - $m1hfusion - $m1c2tftfuion - $m3c3tfti3;
									$mass_2_3 = $res / $c2tfti2;

									//m1 = -m1c1( Tfusion - Ti( 1 ) )-m1hfusion-m1c2( Tf - Tfusion )-m3c3( Tf - Ti3 )/c2( Tf - Ti2 )
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'Ti(2)') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3)  && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {


									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}

									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}
									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}

									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tfusionti1 = $t_fusion_3 - $in_temp_1_3;
									$m1c1tfusionti1 = $m1c1 * $tfusionti1;
									$m1hfusion = $mass_1_3 * $h_fusion_3;

									$m1c2 = $mass_1_3 * $heat_capacity_2_3;
									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$m1c2tftfuion = $m1c2 * $tf_tfusion;

									$m3c3 = $mass_3_3 * $heat_capacity_3_3;
									$tf_ti3 = $fin_temp_3 - $in_temp_3_3;
									$m3c3tfti3 = $m3c3 * $tf_ti3;

									$m2c2tf = $mass_2_3 * $heat_capacity_2_3 * $fin_temp_3;
									$m2c2 = -$mass_2_3 * $heat_capacity_2_3;

									$res = $m1c1tfusionti1 - $m1hfusion - $m1c2tftfuion - $m3c3tfti3 - $m2c2tf;
									$in_temp_2_3 = $res / $m2c2;

									//m1 = -m1c1( Tfusion - Ti( 1 ) )-m1hfusion-m1c2( Tf - Tfusion )-m3c3( Tf - Ti3 )-m2c2Tf/-m2c2
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'm3') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {


									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}

									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}
									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}

									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tfusionti1 = $t_fusion_3 - $in_temp_1_3;
									$m1c1tfusionti1 = $m1c1 * $tfusionti1;

									$m1hfusion = $mass_1_3 * $h_fusion_3;

									$m1c2 = $mass_1_3 * $heat_capacity_2_3;
									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$m1c2tftfuion = $m1c2 * $tf_tfusion;

									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;
									$m2c2tfti2 = $m2c2 * $tf_ti2;

									$tfti3 = $fin_temp_3 - $in_temp_3_3;
									$c3tfti3 = $heat_capacity_3_3 * $tfti3;

									$res = $m1c1tfusionti1 - $m1hfusion - $m1c2tftfuion - $m2c2tfti2;
									$mass_3_3 = $res / $c3tfti3;

									//m1 = -m1c1( Tfusion - Ti( 1 ) )-m1hfusion-m1c2( Tf - Tfusion )-m2c2( Tf - Ti2 )/c3( Tf - Ti3 )
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'c3') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($fin_temp_3) && is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {


									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}

									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($f_t_units_3)) {

										if ($f_t_units_3 == 'Fahrenheit °F') {

											$fin_temp_3 = $fin_temp_3 / (-457.9);
										} else if ($f_t_units_3 == 'celsius °C') {

											$fin_temp_3 = $fin_temp_3 / (-272.15);
										}
									}
									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}
									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}

									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tfusionti1 = $t_fusion_3 - $in_temp_1_3;
									$m1c1tfusionti1 = $m1c1 * $tfusionti1;

									$m1hfusion = $mass_1_3 * $h_fusion_3;

									$m1c2 = $mass_1_3 * $heat_capacity_2_3;
									$tf_tfusion = $fin_temp_3 - $t_fusion_3;
									$m1c2tftfuion = $m1c2 * $tf_tfusion;

									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$tf_ti2 = $fin_temp_3 - $in_temp_2_3;
									$m2c2tfti2 = $m2c2 * $tf_ti2;

									$tfti3 = $fin_temp_3 - $in_temp_3_3;
									$m3tfti3 = $mass_3_3 * $tfti3;

									$res = $m1c1tfusionti1 - $m1hfusion - $m1c2tftfuion - $m2c2tfti2;
									$heat_capacity_3_3 = $res / $m3tfti3;

									//m1 = -m1c1( Tfusion - Ti( 1 ) )-m1hfusion-m1c2( Tf - Tfusion )-m2c2( Tf - Ti2 )/m3( Tf - Ti3 )
								} else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							} else if ($three_time == 'Tf') {
								if (
									is_numeric($mass_1_3) && is_numeric($mass_2_3) && is_numeric($mass_3_3)
									&& is_numeric($heat_capacity_1_3) && is_numeric($heat_capacity_2_3) && is_numeric($heat_capacity_3_3)
									&& is_numeric($in_temp_1_3) && is_numeric($in_temp_2_3) && is_numeric($in_temp_3_3)
									&& is_numeric($t_fusion_3) && is_numeric($h_fusion_3)
								) {

									if (isset($m_units1_3)) {

										if ($m_units1_3 == 'picograms (pg)') {

											$mass_1_3 = $mass_1_3 / 1000000000000;
										} else if ($m_units1_3 == 'nanograms (ng)') {

											$mass_1_3 = $mass_1_3 / 1000000000;
										} else if ($m_units1_3 == 'micrograms (μg)') {

											$mass_1_3 = $mass_1_3 / 1000000;
										} else if ($m_units1_3 == 'milligrams (mg)') {

											$mass_1_3 = $mass_1_3 / 1000;
										} else if ($m_units1_3 == 'decagrams (dag)') {

											$mass_1_3 = $mass_1_3 / 0.1;
										} else if ($m_units1_3 == 'kilograms (kg)') {

											$mass_1_3 = $mass_1_3 / 0.001;
										} else if ($m_units1_3 == 'metric tons (t)') {

											$mass_1_3 = $mass_1_3 / 0.000001;
										} else if ($m_units1_3 == 'grains (gr)') {

											$mass_1_3 = $mass_1_3 / 15.432;
										} else if ($m_units1_3 == 'drachms (dr)') {

											$mass_1_3 = $mass_1_3 / 0.5644;
										} else if ($m_units1_3 == 'ounces (oz)') {

											$mass_1_3 = $mass_1_3 / 0.035274;
										} else if ($m_units1_3 == 'pounds (lb)') {

											$mass_1_3 = $mass_1_3 / 0.0022046;
										} else if ($m_units1_3 == 'stones (stone)') {

											$mass_1_3 = $mass_1_3 / 0.00015747;
										} else if ($m_units1_3 == 'US short tones (US ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000011023;
										} else if ($m_units1_3 == 'imperial tons (Long ton)') {

											$mass_1_3 = $mass_1_3 / 0.0000009842;
										} else if ($m_units1_3 == 'atomic mass_2 unit (u)') {

											$mass_1_3 = $mass_1_3 / 602214000000000000000000;
										} else if ($m_units1_3 == 'troy ounce (oz t)') {

											$mass_1_3 = $mass_1_3 / 0.03215;
										}
									}
									if (isset($m_units2_3)) {

										if ($m_units2_3 == 'picograms (pg)') {

											$mass_2_3 = $mass_2_3 / 1000000000000;
										} else if ($m_units2_3 == 'nanograms (ng)') {

											$mass_2_3 = $mass_2_3 / 1000000000;
										} else if ($m_units2_3 == 'micrograms (μg)') {

											$mass_2_3 = $mass_2_3 / 1000000;
										} else if ($m_units2_3 == 'milligrams (mg)') {

											$mass_2_3 = $mass_2_3 / 1000;
										} else if ($m_units2_3 == 'decagrams (dag)') {

											$mass_2_3 = $mass_2_3 / 0.1;
										} else if ($m_units2_3 == 'kilograms (kg)') {

											$mass_2_3 = $mass_2_3 / 0.001;
										} else if ($m_units2_3 == 'metric tons (t)') {

											$mass_2_3 = $mass_2_3 / 0.000001;
										} else if ($m_units2_3 == 'grains (gr)') {

											$mass_2_3 = $mass_2_3 / 15.432;
										} else if ($m_units2_3 == 'drachms (dr)') {

											$mass_2_3 = $mass_2_3 / 0.5644;
										} else if ($m_units2_3 == 'ounces (oz)') {

											$mass_2_3 = $mass_2_3 / 0.035274;
										} else if ($m_units2_3 == 'pounds (lb)') {

											$mass_2_3 = $mass_2_3 / 0.0022046;
										} else if ($m_units2_3 == 'stones (stone)') {

											$mass_2_3 = $mass_2_3 / 0.00015747;
										} else if ($m_units2_3 == 'US short tones (US ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000011023;
										} else if ($m_units2_3 == 'imperial tons (Long ton)') {

											$mass_2_3 = $mass_2_3 / 0.0000009842;
										} else if ($m_units2_3 == 'atomic mass_2 unit (u)') {

											$mass_2_3 = $mass_2_3 / 602214000000000000000000;
										} else if ($m_units2_3 == 'troy ounce (oz t)') {

											$mass_2_3 = $mass_2_3 / 0.03215;
										}
									}
									if (isset($m_units3_3)) {

										if ($m_units3_3 == 'picograms (pg)') {

											$mass_3_3 = $mass_3_3 / 1000000000000;
										} else if ($m_units3_3 == 'nanograms (ng)') {

											$mass_3_3 = $mass_3_3 / 1000000000;
										} else if ($m_units3_3 == 'micrograms (μg)') {

											$mass_3_3 = $mass_3_3 / 1000000;
										} else if ($m_units3_3 == 'milligrams (mg)') {

											$mass_3_3 = $mass_3_3 / 1000;
										} else if ($m_units3_3 == 'decagrams (dag)') {

											$mass_3_3 = $mass_3_3 / 0.1;
										} else if ($m_units3_3 == 'kilograms (kg)') {

											$mass_3_3 = $mass_3_3 / 0.001;
										} else if ($m_units3_3 == 'metric tons (t)') {

											$mass_3_3 = $mass_3_3 / 0.000001;
										} else if ($m_units3_3 == 'grains (gr)') {

											$mass_3_3 = $mass_3_3 / 15.432;
										} else if ($m_units3_3 == 'drachms (dr)') {

											$mass_3_3 = $mass_3_3 / 0.5644;
										} else if ($m_units3_3 == 'ounces (oz)') {

											$mass_3_3 = $mass_3_3 / 0.035274;
										} else if ($m_units3_3 == 'pounds (lb)') {

											$mass_3_3 = $mass_3_3 / 0.0022046;
										} else if ($m_units3_3 == 'stones (stone)') {

											$mass_3_3 = $mass_3_3 / 0.00015747;
										} else if ($m_units3_3 == 'US short tones (US ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000011023;
										} else if ($m_units3_3 == 'imperial tons (Long ton)') {

											$mass_3_3 = $mass_3_3 / 0.0000009842;
										} else if ($m_units3_3 == 'atomic mass_2 unit (u)') {

											$mass_3_3 = $mass_3_3 / 602214000000000000000000;
										} else if ($m_units3_3 == 'troy ounce (oz t)') {

											$mass_3_3 = $mass_3_3 / 0.03215;
										}
									}
									if (isset($s_heat_units1_3)) {

										if ($s_heat_units1_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1000;
										} elseif ($s_heat_units1_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 1;
										} elseif ($s_heat_units1_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 238.9;
										} elseif ($s_heat_units1_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										} elseif ($s_heat_units1_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_1_3 = $heat_capacity_1_3 / 0.2389;
										}
									}
									if (isset($s_heat_units2_3)) {

										if ($s_heat_units2_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1000;
										} elseif ($s_heat_units2_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 1;
										} elseif ($s_heat_units2_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 238.9;
										} elseif ($s_heat_units2_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										} elseif ($s_heat_units2_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_2_3 = $heat_capacity_2_3 / 0.2389;
										}
									}
									if (isset($s_heat_units3_3)) {

										if ($s_heat_units3_3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per kelvin (cal/g.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1000;
										} elseif ($s_heat_units3_3 == 'joules per gram per celsius J/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 1;
										} elseif ($s_heat_units3_3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 238.9;
										} elseif ($s_heat_units3_3 == 'calories per gram per celsius cal/(g·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										} elseif ($s_heat_units3_3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$heat_capacity_3_3 = $heat_capacity_3_3 / 0.2389;
										}
									}
									if (isset($i_t_units1_3)) {

										if ($i_t_units1_3 == 'Fahrenheit °F') {

											$in_temp_1_3 = $in_temp_1_3 / (-457.9);
										} else if ($i_t_units1_3 == 'celsius °C') {

											$in_temp_1_3 = $in_temp_1_3 / (-272.15);
										}
									}
									if (isset($i_t_units2_3)) {

										if ($i_t_units2_3 == 'Fahrenheit °F') {

											$in_temp_2_3 = $in_temp_2_3 / (-457.9);
										} else if ($i_t_units2_3 == 'celsius °C') {

											$in_temp_2_3 = $in_temp_2_3 / (-272.15);
										}
									}
									if (isset($i_t_units3_3)) {

										if ($i_t_units3_3 == 'Fahrenheit °F') {

											$in_temp_3_3 = $in_temp_3_3 / (-457.9);
										} else if ($i_t_units3_3 == 'celsius °C') {

											$in_temp_3_3 = $in_temp_3_3 / (-272.15);
										}
									}

									if (isset($t_units_3)) {

										if ($t_units_3 == 'Fahrenheit °F') {

											$t_fusion_3 = $t_fusion_3 / (-457.9);
										} else if ($t_units_3 == 'celsius °C') {

											$t_fusion_3 = $t_fusion_3 / (-272.15);
										}
									}
									if (isset($h_units3)) {

										if ($h_units3 == 'joules per kilogram per kelvin J/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'calories per kilogram per kelvin cal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per kelvin (cal/g.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'joules per kilogram per celsius J/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1000;
										} elseif ($h_units3 == 'joules per gram per celsius J/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 1;
										} elseif ($h_units3 == 'calories per kilogram per celsius cal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 238.9;
										} elseif ($h_units3 == 'calories per gram per celsius cal/(g·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										} elseif ($h_units3 == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {

											$h_fusion_3 = $h_fusion_3 / 0.2389;
										}
									}

									$m1c1 = -$mass_1_3 * $heat_capacity_1_3;
									$tfusionti1 = $t_fusion_3 - $in_temp_1_3;
									$m1c1tfusionti1 = $m1c1 * $tfusionti1;

									$m1hfusion = $mass_1_3 * $h_fusion_3;

									$m1c2tfusion = $mass_1_3 * $heat_capacity_2_3 * $t_fusion_3;

									$m2c2ti2 = $mass_2_3 * $heat_capacity_2_3 * $in_temp_2_3;
									$m3c3Ti3 = $mass_3_3 * $heat_capacity_3_3 * $in_temp_3_3;

									$m1c2 = $mass_1_3 * $heat_capacity_2_3;
									$m2c2 = $mass_2_3 * $heat_capacity_2_3;
									$m3c3 = $mass_3_3 * $heat_capacity_3_3;

									$m1c2m2c2m3c3 = $m1c2 + $m2c2 + $m2c2;

									$res = $m1c1tfusionti1 - $m1hfusion + $m1c2tfusion + $m2c2ti2 + $m3c3Ti3;
									$fin_temp_3 = $res / $m1c2m2c2m3c3;
								}
								//m1 = -m1c1( Tfusion - Ti( 1 ) )-m1hfusion+m1c2Tfusion+m2c2Ti2+m3c3Ti3/m1c2 + m2c2 + m3c3
								else {
                                    $this->param['error'] = 'Please! Check Your Input.';
                                    return $this->param;
								}
							}
						}
					}
				}
			} else {

				if (!empty($formula)) {
					if ($formula == 'Heat Energy') {
						if ($type == 'temp_change') {
							if (is_numeric($mass) && is_numeric($heat_capacity) && is_numeric($temp_change)) {

								if (isset($m_units)) {
									if ($m_units == 'picograms (pg)') {
										$mass = $mass / 1000000000000;
									} else if ($m_units == 'nanograms (ng)') {
										$mass = $mass / 1000000000;
									} else if ($m_units == 'micrograms (μg)') {
										$mass = $mass / 1000000;
									} else if ($m_units == 'milligrams (mg)') {
										$mass = $mass / 1000;
									} else if ($m_units == 'decagrams (dag)') {
										$mass = $mass / 0.1;
									} else if ($m_units == 'kilograms (kg)') {
										$mass = $mass / 0.001;
									} else if ($m_units == 'metric tons (t)') {
										$mass = $mass / 0.000001;
									} else if ($m_units == 'grains (gr)') {
										$mass = $mass / 15.432;
									} else if ($m_units == 'drachms (dr)') {
										$mass = $mass / 0.5644;
									} else if ($m_units == 'ounces (oz)') {
										$mass = $mass / 0.035274;
									} else if ($m_units == 'pounds (lb)') {
										$mass = $mass / 0.0022046;
									} else if ($m_units == 'stones (stone)') {
										$mass = $mass / 0.00015747;
									} else if ($m_units == 'US short tones (US ton)') {
										$mass = $mass / 0.0000011023;
									} else if ($m_units == 'imperial tons (Long ton)') {
										$mass = $mass / 0.0000009842;
									} else if ($m_units == 'atomic mass unit (u)') {
										$mass = $mass / 602214000000000000000000;
									} else if ($m_units == 'troy ounce (oz t)') {
										$mass = $mass / 0.03215;
									}
								}
								if (isset($s_heat_units)) {

									if ($s_heat_units == 'joules per kilogram per kelvin J/(kg.k)') {
										$heat_capacity = $heat_capacity / 1000;
									} else if ($s_heat_units == 'calories per kilogram per kelvin cal/(kg.k)') {
										$heat_capacity = $heat_capacity / 238.9;
									} else if ($s_heat_units == 'calories per gram per kelvin (cal/g.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} else if ($s_heat_units == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} else if ($s_heat_units == 'joules per kilogram per celsius J/(kg·°C)') {
										$heat_capacity = $heat_capacity / 1000;
									} else if ($s_heat_units == 'joules per gram per celsius J/(g·°C)') {
										$heat_capacity = $heat_capacity / 1;
									} else if ($s_heat_units == 'calories per kilogram per celsius cal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per celsius cal/(g·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									}
								}

								if (isset($t_c_units)) {
									if ($t_c_units == 'Fahrenheit °F') {
										$temp_change = $temp_change / -457.9;
									} else if ($t_c_units == 'celsius °C') {
										$temp_change = $temp_change /  -272.15;
									}
								}

								$energy = $mass * $heat_capacity * $temp_change;
							} else {
                                $this->param['error'] = 'Please! Check Your Input.';
                                return $this->param;
							}
						} elseif ($type == 'i_f_temp') {
							if (is_numeric($mass) && is_numeric($heat_capacity) && is_numeric($in_temp) && is_numeric($s_fin_temp)) {
								if (isset($m_units)) {
									if ($m_units == 'picograms (pg)') {
										$mass = $mass / 1000000000000;
									} else if ($m_units == 'nanograms (ng)') {
										$mass = $mass / 1000000000;
									} else if ($m_units == 'micrograms (μg)') {
										$mass = $mass / 1000000;
									} else if ($m_units == 'milligrams (mg)') {
										$mass = $mass / 1000;
									} else if ($m_units == 'decagrams (dag)') {
										$mass = $mass / 0.1;
									} else if ($m_units == 'kilograms (kg)') {
										$mass = $mass / 0.001;
									} else if ($m_units == 'metric tons (t)') {
										$mass = $mass / 0.000001;
									} else if ($m_units == 'grains (gr)') {
										$mass = $mass / 15.432;
									} else if ($m_units == 'drachms (dr)') {
										$mass = $mass / 0.5644;
									} else if ($m_units == 'ounces (oz)') {
										$mass = $mass / 0.035274;
									} else if ($m_units == 'pounds (lb)') {
										$mass = $mass / 0.0022046;
									} else if ($m_units == 'stones (stone)') {
										$mass = $mass / 0.00015747;
									} else if ($m_units == 'US short tones (US ton)') {
										$mass = $mass / 0.0000011023;
									} else if ($m_units == 'imperial tons (Long ton)') {
										$mass = $mass / 0.0000009842;
									} else if ($m_units == 'atomic mass unit (u)') {
										$mass = $mass / 602214000000000000000000;
									} else if ($m_units == 'troy ounce (oz t)') {
										$mass = $mass / 0.03215;
									}
								}
								if (isset($s_heat_units)) {
									if ($s_heat_units == 'joules per kilogram per kelvin J/(kg.k)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'calories per kilogram per kelvin cal/(kg.k)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per kelvin (cal/g.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'joules per kilogram per celsius J/(kg·°C)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'joules per gram per celsius J/(g·°C)') {
										$heat_capacity = $heat_capacity / 1;
									} elseif ($s_heat_units == 'calories per kilogram per celsius cal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per celsius cal/(g·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									}
								}
								if (isset($i_t_units)) {
									if ($i_t_units == 'Fahrenheit °F') {
										$in_temp = $in_temp / (-457.9);
									} else if ($i_t_units == 'celsius °C') {
										$in_temp = $in_temp / (-272.15);
									}
								}
								if (isset($S_f_t_units)) {

									if ($S_f_t_units == 'Fahrenheit °F') {

										$s_fin_temp = $s_fin_temp / -457.9;
									} else if ($S_f_t_units == 'celsius °C') {

										$s_fin_temp = $s_fin_temp / -272.15;
									}
								}

								$temp_change = $s_fin_temp - $in_temp;
								$energy = $mass * $heat_capacity * $temp_change;
							} else {
                                $this->param['error'] = 'Please! Check Your Input.';
                                return $this->param;
							}
						}
					}
					if ($formula == 'Specific Heat') {
						if ($type == 'temp_change') {
							if (is_numeric($energy) && is_numeric($mass) && is_numeric($temp_change)) {
								if (isset($units)) {
									$unit = $units;
									if ($unit == 'nanojoules (nj)') {
										$energy = $energy / 1000000000;
									} else if ($unit == 'microjoules (μJ)') {
										$energy = $energy / 1000000;
									} else if ($unit == 'millijoules (mJ)') {
										$energy = $energy / 1000;
									} else if ($unit == 'kilojoules (kJ)') {
										$energy = $energy * 1000;
									} else if ($unit == 'megajoules (MJ)') {
										$energy = $energy * 1000000;
									} else if ($unit == 'watt hours (Wh)') {
										$energy = $energy * 3600;
									} else if ($unit == 'kilowatt hours (kWh)') {
										$energy = $energy * 3600000;
									} else if ($unit == 'foot-pounds (ft-lbs)') {
										$energy = $energy * 1.3558;
									} else if ($unit == 'calories (cal)') {
										$energy = $energy * 4.184;
									} else if ($unit == 'kilocalories (Kcal)') {
										$energy = $energy * 4184;
									} else if ($unit == 'megacalories (Mcal)') {
										$energy = $energy * 4184000;
									} else if ($unit == 'nanoelectronovolts (neV)') {
										$energy = $energy / 6241509074460762607776240981;
									} else if ($unit == 'microelectronovolts (μeV)') {
										$energy = $energy / 6241509074460762607776241;
									} else if ($unit == 'millielectronovolts (meV)') {
										$energy = $energy * 1.60218E-22;
									} else if ($unit == 'electronvolts (eV)') {
										$energy = $energy / 6.242e+18;
									} else if ($unit == 'kiloelectronovolts (KeV)') {
										$energy = $energy / 6.242e+15;
									} else if ($unit == 'megaelectronovolts (MeV)') {
										$energy = $energy * 1.6022E-13;
									}
								}
								if (isset($m_units)) {
									if ($m_units == 'picograms (pg)') {
										$mass = $mass / 1000000000000;
									} else if ($m_units == 'nanograms (ng)') {
										$mass = $mass / 1000000000;
									} else if ($m_units == 'micrograms (μg)') {
										$mass = $mass / 1000000;
									} else if ($m_units == 'milligrams (mg)') {
										$mass = $mass / 1000;
									} else if ($m_units == 'decagrams (dag)') {
										$mass = $mass / 0.1;
									} else if ($m_units == 'kilograms (kg)') {
										$mass = $mass / 0.001;
									} else if ($m_units == 'metric tons (t)') {
										$mass = $mass / 0.000001;
									} else if ($m_units == 'grains (gr)') {
										$mass = $mass / 15.432;
									} else if ($m_units == 'drachms (dr)') {
										$mass = $mass / 0.5644;
									} else if ($m_units == 'ounces (oz)') {
										$mass = $mass / 0.035274;
									} else if ($m_units == 'pounds (lb)') {
										$mass = $mass / 0.0022046;
									} else if ($m_units == 'stones (stone)') {
										$mass = $mass / 0.00015747;
									} else if ($m_units == 'US short tones (US ton)') {
										$mass = $mass / 0.0000011023;
									} else if ($m_units == 'imperial tons (Long ton)') {
										$mass = $mass / 0.0000009842;
									} else if ($m_units == 'atomic mass unit (u)') {
										$mass = $mass / 602214000000000000000000;
									} else if ($m_units == 'troy ounce (oz t)') {
										$mass = $mass / 0.03215;
									}
								}
								if (isset($t_c_units)) {
									if ($t_c_units == 'Fahrenheit °F') {
										$temp_change = $temp_change / (-457.9);
									} else if ($t_c_units == 'celsius °C') {
										$temp_change = $temp_change / (-272.15);
									}
								}
								$res = $mass * $temp_change;
								$heat_capacity = $energy / $res;
							} else {
                                $this->param['error'] = 'Please! Check Your Input.';
                                return $this->param;
							}
						} elseif ($type == 'i_f_temp') {
							if (is_numeric($energy) && is_numeric($mass) && is_numeric($in_temp) && is_numeric($s_fin_temp)) {
								if (isset($units)) {
									$unit = $units;
									if ($unit == 'nanojoules (nj)') {
										$energy = $energy / 1000000000;
									} else if ($unit == 'microjoules (μJ)') {
										$energy = $energy / 1000000;
									} else if ($unit == 'millijoules (mJ)') {
										$energy = $energy / 1000;
									} else if ($unit == 'kilojoules (kJ)') {
										$energy = $energy * 1000;
									} else if ($unit == 'megajoules (MJ)') {
										$energy = $energy * 1000000;
									} else if ($unit == 'watt hours (Wh)') {
										$energy = $energy * 3600;
									} else if ($unit == 'kilowatt hours (kWh)') {
										$energy = $energy * 3600000;
									} else if ($unit == 'foot-pounds (ft-lbs)') {
										$energy = $energy * 1.3558;
									} else if ($unit == 'calories (cal)') {
										$energy = $energy * 4.184;
									} else if ($unit == 'kilocalories (Kcal)') {
										$energy = $energy * 4184;
									} else if ($unit == 'megacalories (Mcal)') {
										$energy = $energy * 4184000;
									} else if ($unit == 'nanoelectronovolts (neV)') {
										$energy = $energy / 6241509074460762607776240981;
									} else if ($unit == 'microelectronovolts (μeV)') {
										$energy = $energy / 6241509074460762607776241;
									} else if ($unit == 'millielectronovolts (meV)') {
										$energy = $energy * 1.60218E-22;
									} else if ($unit == 'electronvolts (eV)') {
										$energy = $energy / 6.242e+18;
									} else if ($unit == 'kiloelectronovolts (KeV)') {
										$energy = $energy / 6.242e+15;
									} else if ($unit == 'megaelectronovolts (MeV)') {
										$energy = $energy * 1.6022E-13;
									}
								}
								if (isset($m_units)) {
									if ($m_units == 'picograms (pg)') {
										$mass = $mass / 1000000000000;
									} else if ($m_units == 'nanograms (ng)') {
										$mass = $mass / 1000000000;
									} else if ($m_units == 'micrograms (μg)') {
										$mass = $mass / 1000000;
									} else if ($m_units == 'milligrams (mg)') {
										$mass = $mass / 1000;
									} else if ($m_units == 'decagrams (dag)') {
										$mass = $mass / 0.1;
									} else if ($m_units == 'kilograms (kg)') {
										$mass = $mass / 0.001;
									} else if ($m_units == 'metric tons (t)') {
										$mass = $mass / 0.000001;
									} else if ($m_units == 'grains (gr)') {
										$mass = $mass / 15.432;
									} else if ($m_units == 'drachms (dr)') {
										$mass = $mass / 0.5644;
									} else if ($m_units == 'ounces (oz)') {
										$mass = $mass / 0.035274;
									} else if ($m_units == 'pounds (lb)') {
										$mass = $mass / 0.0022046;
									} else if ($m_units == 'stones (stone)') {
										$mass = $mass / 0.00015747;
									} else if ($m_units == 'US short tones (US ton)') {
										$mass = $mass / 0.0000011023;
									} else if ($m_units == 'imperial tons (Long ton)') {
										$mass = $mass / 0.0000009842;
									} else if ($m_units == 'atomic mass unit (u)') {
										$mass = $mass / 602214000000000000000000;
									} else if ($m_units == 'troy ounce (oz t)') {
										$mass = $mass / 0.03215;
									}
								}
								if (isset($i_t_units)) {
									if ($i_t_units == 'Fahrenheit °F') {
										$in_temp = $in_temp / (-457.9);
									} else if ($i_t_units == 'celsius °C') {
										$in_temp = $in_temp / (-272.15);
									}
								}
								if (isset($S_f_t_units)) {

									if ($S_f_t_units == 'Fahrenheit °F') {

										$s_fin_temp = $s_fin_temp / -457.9;
									} else if ($S_f_t_units == 'celsius °C') {

										$s_fin_temp = $s_fin_temp / -272.15;
									}
								}

								$temp_change = $s_fin_temp - $in_temp;
								$res = $mass * $temp_change;
								$heat_capacity = $energy / $res;
							} else {
                                $this->param['error'] = 'Please! Check Your Input.';
                                return $this->param;
							}
						}
					} elseif ($formula == 'Mass') {
						if ($type == 'temp_change') {
							if (is_numeric($energy) && is_numeric($heat_capacity) && is_numeric($temp_change)) {
								if (isset($units)) {
									$unit = $units;
									if ($unit == 'nanojoules (nj)') {
										$energy = $energy / 1000000000;
									} else if ($unit == 'microjoules (μJ)') {
										$energy = $energy / 1000000;
									} else if ($unit == 'millijoules (mJ)') {
										$energy = $energy / 1000;
									} else if ($unit == 'kilojoules (kJ)') {
										$energy = $energy * 1000;
									} else if ($unit == 'megajoules (MJ)') {
										$energy = $energy * 1000000;
									} else if ($unit == 'watt hours (Wh)') {
										$energy = $energy * 3600;
									} else if ($unit == 'kilowatt hours (kWh)') {
										$energy = $energy * 3600000;
									} else if ($unit == 'foot-pounds (ft-lbs)') {
										$energy = $energy * 1.3558;
									} else if ($unit == 'calories (cal)') {
										$energy = $energy * 4.184;
									} else if ($unit == 'kilocalories (Kcal)') {
										$energy = $energy * 4184;
									} else if ($unit == 'megacalories (Mcal)') {
										$energy = $energy * 4184000;
									} else if ($unit == 'nanoelectronovolts (neV)') {
										$energy = $energy / 6241509074460762607776240981;
									} else if ($unit == 'microelectronovolts (μeV)') {
										$energy = $energy / 6241509074460762607776241;
									} else if ($unit == 'millielectronovolts (meV)') {
										$energy = $energy * 1.60218E-22;
									} else if ($unit == 'electronvolts (eV)') {
										$energy = $energy / 6.242e+18;
									} else if ($unit == 'kiloelectronovolts (KeV)') {
										$energy = $energy / 6.242e+15;
									} else if ($unit == 'megaelectronovolts (MeV)') {
										$energy = $energy * 1.6022E-13;
									}
								}
								if (isset($s_heat_units)) {
									if ($s_heat_units == 'joules per kilogram per kelvin J/(kg.k)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'calories per kilogram per kelvin cal/(kg.k)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per kelvin (cal/g.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'joules per kilogram per celsius J/(kg·°C)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'joules per gram per celsius J/(g·°C)') {
										$heat_capacity = $heat_capacity / 1;
									} elseif ($s_heat_units == 'calories per kilogram per celsius cal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per celsius cal/(g·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									}
								}
								if (isset($t_c_units)) {
									if ($t_c_units == 'Fahrenheit °F') {
										$temp_change = $temp_change / (-457.9);
									} else if ($t_c_units == 'celsius °C') {
										$temp_change = $temp_change / (-272.15);
									}
								}

								$res = $heat_capacity * $temp_change;
								$mass = $energy / $res;
							} else {
                                $this->param['error'] = 'Please! Check Your Input.';
                                return $this->param;
							}
						} elseif ($type == 'i_f_temp') {
							if (is_numeric($energy) && is_numeric($heat_capacity) && is_numeric($in_temp) && is_numeric($s_fin_temp)) {
								if (isset($units)) {
									$unit = $units;
									if ($unit == 'nanojoules (nj)') {
										$energy = $energy / 1000000000;
									} else if ($unit == 'microjoules (μJ)') {
										$energy = $energy / 1000000;
									} else if ($unit == 'millijoules (mJ)') {
										$energy = $energy / 1000;
									} else if ($unit == 'kilojoules (kJ)') {
										$energy = $energy * 1000;
									} else if ($unit == 'megajoules (MJ)') {
										$energy = $energy * 1000000;
									} else if ($unit == 'watt hours (Wh)') {
										$energy = $energy * 3600;
									} else if ($unit == 'kilowatt hours (kWh)') {
										$energy = $energy * 3600000;
									} else if ($unit == 'foot-pounds (ft-lbs)') {
										$energy = $energy * 1.3558;
									} else if ($unit == 'calories (cal)') {
										$energy = $energy * 4.184;
									} else if ($unit == 'kilocalories (Kcal)') {
										$energy = $energy * 4184;
									} else if ($unit == 'megacalories (Mcal)') {
										$energy = $energy * 4184000;
									} else if ($unit == 'nanoelectronovolts (neV)') {
										$energy = $energy / 6241509074460762607776240981;
									} else if ($unit == 'microelectronovolts (μeV)') {
										$energy = $energy / 6241509074460762607776241;
									} else if ($unit == 'millielectronovolts (meV)') {
										$energy = $energy * 1.60218E-22;
									} else if ($unit == 'electronvolts (eV)') {
										$energy = $energy / 6.242e+18;
									} else if ($unit == 'kiloelectronovolts (KeV)') {
										$energy = $energy / 6.242e+15;
									} else if ($unit == 'megaelectronovolts (MeV)') {
										$energy = $energy * 1.6022E-13;
									}
								}
								if (isset($s_heat_units)) {
									if ($s_heat_units == 'joules per kilogram per kelvin J/(kg.k)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'calories per kilogram per kelvin cal/(kg.k)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per kelvin (cal/g.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'joules per kilogram per celsius J/(kg·°C)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'joules per gram per celsius J/(g·°C)') {
										$heat_capacity = $heat_capacity / 1;
									} elseif ($s_heat_units == 'calories per kilogram per celsius cal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per celsius cal/(g·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									}
								}
								if (isset($i_t_units)) {
									if ($i_t_units == 'Fahrenheit °F') {
										$in_temp = $in_temp / (-457.9);
									} else if ($i_t_units == 'celsius °C') {
										$in_temp = $in_temp / (-272.15);
									}
								}
								if (isset($S_f_t_units)) {

									if ($S_f_t_units == 'Fahrenheit °F') {

										$s_fin_temp = $s_fin_temp / -457.9;
									} else if ($S_f_t_units == 'celsius °C') {

										$s_fin_temp = $s_fin_temp / -272.15;
									}
								}

								$temp_change = $s_fin_temp - $in_temp;
								$res = $heat_capacity * $temp_change;
								$mass = $energy / $res;
							} else {
                                $this->param['error'] = 'Please! Check Your Input.';
                                return $this->param;
							}
						}
					} elseif ($formula == 'Initial_Temperature') {
						if (is_numeric($energy) && is_numeric($mass) && is_numeric($heat_capacity)  && is_numeric($s_fin_temp)) {

							if (isset($units)) {
								$unit = $units;
								if ($unit == 'nanojoules (nj)') {
									$energy = $energy / 1000000000;
								} else if ($unit == 'microjoules (μJ)') {
									$energy = $energy / 1000000;
								} else if ($unit == 'millijoules (mJ)') {
									$energy = $energy / 1000;
								} else if ($unit == 'kilojoules (kJ)') {
									$energy = $energy * 1000;
								} else if ($unit == 'megajoules (MJ)') {
									$energy = $energy * 1000000;
								} else if ($unit == 'watt hours (Wh)') {
									$energy = $energy * 3600;
								} else if ($unit == 'kilowatt hours (kWh)') {
									$energy = $energy * 3600000;
								} else if ($unit == 'foot-pounds (ft-lbs)') {
									$energy = $energy * 1.3558;
								} else if ($unit == 'calories (cal)') {
									$energy = $energy * 4.184;
								} else if ($unit == 'kilocalories (Kcal)') {
									$energy = $energy * 4184;
								} else if ($unit == 'megacalories (Mcal)') {
									$energy = $energy * 4184000;
								} else if ($unit == 'nanoelectronovolts (neV)') {
									$energy = $energy / 6241509074460762607776240981;
								} else if ($unit == 'microelectronovolts (μeV)') {
									$energy = $energy / 6241509074460762607776241;
								} else if ($unit == 'millielectronovolts (meV)') {
									$energy = $energy * 1.60218E-22;
								} else if ($unit == 'electronvolts (eV)') {
									$energy = $energy / 6.242e+18;
								} else if ($unit == 'kiloelectronovolts (KeV)') {
									$energy = $energy / 6.242e+15;
								} else if ($unit == 'megaelectronovolts (MeV)') {
									$energy = $energy * 1.6022E-13;
								}
							}
							if (isset($m_units)) {
								if ($m_units == 'picograms (pg)') {
									$mass = $mass / 1000000000000;
								} else if ($m_units == 'nanograms (ng)') {
									$mass = $mass / 1000000000;
								} else if ($m_units == 'micrograms (μg)') {
									$mass = $mass / 1000000;
								} else if ($m_units == 'milligrams (mg)') {
									$mass = $mass / 1000;
								} else if ($m_units == 'decagrams (dag)') {
									$mass = $mass / 0.1;
								} else if ($m_units == 'kilograms (kg)') {
									$mass = $mass / 0.001;
								} else if ($m_units == 'metric tons (t)') {
									$mass = $mass / 0.000001;
								} else if ($m_units == 'grains (gr)') {
									$mass = $mass / 15.432;
								} else if ($m_units == 'drachms (dr)') {
									$mass = $mass / 0.5644;
								} else if ($m_units == 'ounces (oz)') {
									$mass = $mass / 0.035274;
								} else if ($m_units == 'pounds (lb)') {
									$mass = $mass / 0.0022046;
								} else if ($m_units == 'stones (stone)') {
									$mass = $mass / 0.00015747;
								} else if ($m_units == 'US short tones (US ton)') {
									$mass = $mass / 0.0000011023;
								} else if ($m_units == 'imperial tons (Long ton)') {
									$mass = $mass / 0.0000009842;
								} else if ($m_units == 'atomic mass unit (u)') {
									$mass = $mass / 602214000000000000000000;
								} else if ($m_units == 'troy ounce (oz t)') {
									$mass = $mass / 0.03215;
								}
							}
							if (isset($s_heat_units)) {
								if ($s_heat_units == 'joules per kilogram per kelvin J/(kg.k)') {
									$heat_capacity = $heat_capacity / 1000;
								} elseif ($s_heat_units == 'calories per kilogram per kelvin cal/(kg.k)') {
									$heat_capacity = $heat_capacity / 238.9;
								} elseif ($s_heat_units == 'calories per gram per kelvin (cal/g.k)') {
									$heat_capacity = $heat_capacity / 0.2389;
								} elseif ($s_heat_units == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {
									$heat_capacity = $heat_capacity / 0.2389;
								} elseif ($s_heat_units == 'joules per kilogram per celsius J/(kg·°C)') {
									$heat_capacity = $heat_capacity / 1000;
								} elseif ($s_heat_units == 'joules per gram per celsius J/(g·°C)') {
									$heat_capacity = $heat_capacity / 1;
								} elseif ($s_heat_units == 'calories per kilogram per celsius cal/(kg·°C)') {
									$heat_capacity = $heat_capacity / 238.9;
								} elseif ($s_heat_units == 'calories per gram per celsius cal/(g·°C)') {
									$heat_capacity = $heat_capacity / 0.2389;
								} elseif ($s_heat_units == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {
									$heat_capacity = $heat_capacity / 0.2389;
								}
							}
							if (isset($S_f_t_units)) {
								if ($S_f_t_units == 'Fahrenheit °F') {
									$s_fin_temp = $s_fin_temp / (-457.9);
								} else if ($S_f_t_units == 'celsius °C') {
									$s_fin_temp = $s_fin_temp / (-272.15);
								}
							}

							$res =  $mass * $heat_capacity - $s_fin_temp;
							$in_temp = $energy / $res;
						} else {
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					} elseif ($formula == 'Final_Temperature') {
						if (is_numeric($energy) && is_numeric($mass) && is_numeric($heat_capacity)  && is_numeric($in_temp)) {
							if (isset($units)) {
								$unit = $units;
								if ($unit == 'nanojoules (nj)') {
									$energy = $energy / 1000000000;
								} else if ($unit == 'microjoules (μJ)') {
									$energy = $energy / 1000000;
								} else if ($unit == 'millijoules (mJ)') {
									$energy = $energy / 1000;
								} else if ($unit == 'kilojoules (kJ)') {
									$energy = $energy * 1000;
								} else if ($unit == 'megajoules (MJ)') {
									$energy = $energy * 1000000;
								} else if ($unit == 'watt hours (Wh)') {
									$energy = $energy * 3600;
								} else if ($unit == 'kilowatt hours (kWh)') {
									$energy = $energy * 3600000;
								} else if ($unit == 'foot-pounds (ft-lbs)') {
									$energy = $energy * 1.3558;
								} else if ($unit == 'calories (cal)') {
									$energy = $energy * 4.184;
								} else if ($unit == 'kilocalories (Kcal)') {
									$energy = $energy * 4184;
								} else if ($unit == 'megacalories (Mcal)') {
									$energy = $energy * 4184000;
								} else if ($unit == 'nanoelectronovolts (neV)') {
									$energy = $energy / 6241509074460762607776240981;
								} else if ($unit == 'microelectronovolts (μeV)') {
									$energy = $energy / 6241509074460762607776241;
								} else if ($unit == 'millielectronovolts (meV)') {
									$energy = $energy * 1.60218E-22;
								} else if ($unit == 'electronvolts (eV)') {
									$energy = $energy / 6.242e+18;
								} else if ($unit == 'kiloelectronovolts (KeV)') {
									$energy = $energy / 6.242e+15;
								} else if ($unit == 'megaelectronovolts (MeV)') {
									$energy = $energy * 1.6022E-13;
								}
							}
							if (isset($m_units)) {
								if ($m_units == 'picograms (pg)') {
									$mass = $mass / 1000000000000;
								} else if ($m_units == 'nanograms (ng)') {
									$mass = $mass / 1000000000;
								} else if ($m_units == 'micrograms (μg)') {
									$mass = $mass / 1000000;
								} else if ($m_units == 'milligrams (mg)') {
									$mass = $mass / 1000;
								} else if ($m_units == 'decagrams (dag)') {
									$mass = $mass / 0.1;
								} else if ($m_units == 'kilograms (kg)') {
									$mass = $mass / 0.001;
								} else if ($m_units == 'metric tons (t)') {
									$mass = $mass / 0.000001;
								} else if ($m_units == 'grains (gr)') {
									$mass = $mass / 15.432;
								} else if ($m_units == 'drachms (dr)') {
									$mass = $mass / 0.5644;
								} else if ($m_units == 'ounces (oz)') {
									$mass = $mass / 0.035274;
								} else if ($m_units == 'pounds (lb)') {
									$mass = $mass / 0.0022046;
								} else if ($m_units == 'stones (stone)') {
									$mass = $mass / 0.00015747;
								} else if ($m_units == 'US short tones (US ton)') {
									$mass = $mass / 0.0000011023;
								} else if ($m_units == 'imperial tons (Long ton)') {
									$mass = $mass / 0.0000009842;
								} else if ($m_units == 'atomic mass unit (u)') {
									$mass = $mass / 602214000000000000000000;
								} else if ($m_units == 'troy ounce (oz t)') {
									$mass = $mass / 0.03215;
								}
							}
							if (isset($s_heat_units)) {
								if ($s_heat_units == 'joules per kilogram per kelvin J/(kg.k)') {
									$heat_capacity = $heat_capacity / 1000;
								} elseif ($s_heat_units == 'calories per kilogram per kelvin cal/(kg.k)') {
									$heat_capacity = $heat_capacity / 238.9;
								} elseif ($s_heat_units == 'calories per gram per kelvin (cal/g.k)') {
									$heat_capacity = $heat_capacity / 0.2389;
								} elseif ($s_heat_units == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {
									$heat_capacity = $heat_capacity / 0.2389;
								} elseif ($s_heat_units == 'joules per kilogram per celsius J/(kg·°C)') {
									$heat_capacity = $heat_capacity / 1000;
								} elseif ($s_heat_units == 'joules per gram per celsius J/(g·°C)') {
									$heat_capacity = $heat_capacity / 1;
								} elseif ($s_heat_units == 'calories per kilogram per celsius cal/(kg·°C)') {
									$heat_capacity = $heat_capacity / 238.9;
								} elseif ($s_heat_units == 'calories per gram per celsius cal/(g·°C)') {
									$heat_capacity = $heat_capacity / 0.2389;
								} elseif ($s_heat_units == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {
									$heat_capacity = $heat_capacity / 0.2389;
								}
							}
							if (isset($i_t_units)) {
								if ($i_t_units == 'Fahrenheit °F') {
									$in_temp = $in_temp / (-457.9);
								} else if ($i_t_units == 'celsius °C') {
									$in_temp = $in_temp / (-272.15);
								}
							}
							$res =  $mass * $heat_capacity;
							$fin_temp = $energy / $res + $in_temp;
						} else {
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					} elseif ($formula == 'Enthalpy_change') {
						if (is_numeric($energy) && is_numeric($subtance_mass) && is_numeric($molar_mass)) {
							if (isset($units)) {
								$unit = $units;
								if ($unit == 'nanojoules (nj)') {
									$energy = $energy / 1000000000;
								} else if ($unit == 'microjoules (μJ)') {
									$energy = $energy / 1000000;
								} else if ($unit == 'millijoules (mJ)') {
									$energy = $energy / 1000;
								} else if ($unit == 'kilojoules (kJ)') {
									$energy = $energy * 1000;
								} else if ($unit == 'megajoules (MJ)') {
									$energy = $energy * 1000000;
								} else if ($unit == 'watt hours (Wh)') {
									$energy = $energy * 3600;
								} else if ($unit == 'kilowatt hours (kWh)') {
									$energy = $energy * 3600000;
								} else if ($unit == 'foot-pounds (ft-lbs)') {
									$energy = $energy * 1.3558;
								} else if ($unit == 'calories (cal)') {
									$energy = $energy * 4.184;
								} else if ($unit == 'kilocalories (Kcal)') {
									$energy = $energy * 4184;
								} else if ($unit == 'megacalories (Mcal)') {
									$energy = $energy * 4184000;
								} else if ($unit == 'nanoelectronovolts (neV)') {
									$energy = $energy / 6241509074460762607776240981;
								} else if ($unit == 'microelectronovolts (μeV)') {
									$energy = $energy / 6241509074460762607776241;
								} else if ($unit == 'millielectronovolts (meV)') {
									$energy = $energy * 1.60218E-22;
								} else if ($unit == 'electronvolts (eV)') {
									$energy = $energy / 6.242e+18;
								} else if ($unit == 'kiloelectronovolts (KeV)') {
									$energy = $energy / 6.242e+15;
								} else if ($unit == 'megaelectronovolts (MeV)') {
									$energy = $energy * 1.6022E-13;
								}
							}
							if (isset($s_m_units)) {
								if ($s_m_units == 'picograms (pg)') {
									$subtance_mass = $subtance_mass / 1000000000000;
								} else if ($s_m_units == 'nanograms (ng)') {
									$subtance_mass = $subtance_mass / 1000000000;
								} else if ($s_m_units == 'micrograms (μg)') {
									$subtance_mass = $subtance_mass / 1000000;
								} else if ($s_m_units == 'milligrams (mg)') {
									$subtance_mass = $subtance_mass / 1000;
								} else if ($s_m_units == 'decagrams (dag)') {
									$subtance_mass = $subtance_mass / 0.1;
								} else if ($s_m_units == 'kilograms (kg)') {
									$subtance_mass = $subtance_mass / 0.001;
								} else if ($s_m_units == 'metric tons (t)') {
									$subtance_mass = $subtance_mass / 0.000001;
								} else if ($s_m_units == 'grains (gr)') {
									$subtance_mass = $subtance_mass / 15.432;
								} else if ($s_m_units == 'drachms (dr)') {
									$subtance_mass = $subtance_mass / 0.5644;
								} else if ($s_m_units == 'ounces (oz)') {
									$subtance_mass = $subtance_mass / 0.035274;
								} else if ($s_m_units == 'pounds (lb)') {
									$subtance_mass = $subtance_mass / 0.0022046;
								} else if ($s_m_units == 'stones (stone)') {
									$subtance_mass = $subtance_mass / 0.00015747;
								} else if ($s_m_units == 'US short tones (US ton)') {
									$subtance_mass = $subtance_mass / 0.0000011023;
								} else if ($s_m_units == 'imperial tons (Long ton)') {
									$subtance_mass = $subtance_mass / 0.0000009842;
								} else if ($s_m_units == 'atomic mass unit (u)') {
									$subtance_mass = $subtance_mass / 602214000000000000000000;
								} else if ($s_m_units == 'troy ounce (oz t)') {
									$subtance_mass = $subtance_mass / 0.03215;
								}
							}
							$enthalpy_change = $molar_mass * $energy / $subtance_mass;
							$enthalpy_change_2 = 	- ($enthalpy_change);
						} else {
                            $this->param['error'] = 'Please! Check Your Input.';
                            return $this->param;
						}
					} elseif ($formula == 'Time_of_isolation') {
						if ($type == 'temp_change') {
							if (is_numeric($energy) && is_numeric($mass) && is_numeric($heat_capacity)  && is_numeric($temp_change)) {
								if (isset($units)) {
									$unit = $units;
									if ($unit == 'nanojoules (nj)') {
										$energy = $energy / 1000000000;
									} else if ($unit == 'microjoules (μJ)') {
										$energy = $energy / 1000000;
									} else if ($unit == 'millijoules (mJ)') {
										$energy = $energy / 1000;
									} else if ($unit == 'kilojoules (kJ)') {
										$energy = $energy * 1000;
									} else if ($unit == 'megajoules (MJ)') {
										$energy = $energy * 1000000;
									} else if ($unit == 'watt hours (Wh)') {
										$energy = $energy * 3600;
									} else if ($unit == 'kilowatt hours (kWh)') {
										$energy = $energy * 3600000;
									} else if ($unit == 'foot-pounds (ft-lbs)') {
										$energy = $energy * 1.3558;
									} else if ($unit == 'calories (cal)') {
										$energy = $energy * 4.184;
									} else if ($unit == 'kilocalories (Kcal)') {
										$energy = $energy * 4184;
									} else if ($unit == 'megacalories (Mcal)') {
										$energy = $energy * 4184000;
									} else if ($unit == 'nanoelectronovolts (neV)') {
										$energy = $energy / 6241509074460762607776240981;
									} else if ($unit == 'microelectronovolts (μeV)') {
										$energy = $energy / 6241509074460762607776241;
									} else if ($unit == 'millielectronovolts (meV)') {
										$energy = $energy * 1.60218E-22;
									} else if ($unit == 'electronvolts (eV)') {
										$energy = $energy / 6.242e+18;
									} else if ($unit == 'kiloelectronovolts (KeV)') {
										$energy = $energy / 6.242e+15;
									} else if ($unit == 'megaelectronovolts (MeV)') {
										$energy = $energy * 1.6022E-13;
									}
								}
								if (isset($m_units)) {
									if ($m_units == 'picograms (pg)') {
										$mass = $mass / 1000000000000;
									} else if ($m_units == 'nanograms (ng)') {
										$mass = $mass / 1000000000;
									} else if ($m_units == 'micrograms (μg)') {
										$mass = $mass / 1000000;
									} else if ($m_units == 'milligrams (mg)') {
										$mass = $mass / 1000;
									} else if ($m_units == 'decagrams (dag)') {
										$mass = $mass / 0.1;
									} else if ($m_units == 'kilograms (kg)') {
										$mass = $mass / 0.001;
									} else if ($m_units == 'metric tons (t)') {
										$mass = $mass / 0.000001;
									} else if ($m_units == 'grains (gr)') {
										$mass = $mass / 15.432;
									} else if ($m_units == 'drachms (dr)') {
										$mass = $mass / 0.5644;
									} else if ($m_units == 'ounces (oz)') {
										$mass = $mass / 0.035274;
									} else if ($m_units == 'pounds (lb)') {
										$mass = $mass / 0.0022046;
									} else if ($m_units == 'stones (stone)') {
										$mass = $mass / 0.00015747;
									} else if ($m_units == 'US short tones (US ton)') {
										$mass = $mass / 0.0000011023;
									} else if ($m_units == 'imperial tons (Long ton)') {
										$mass = $mass / 0.0000009842;
									} else if ($m_units == 'atomic mass unit (u)') {
										$mass = $mass / 602214000000000000000000;
									} else if ($m_units == 'troy ounce (oz t)') {
										$mass = $mass / 0.03215;
									}
								}
								if (isset($s_heat_units)) {
									if ($s_heat_units == 'joules per kilogram per kelvin J/(kg.k)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'calories per kilogram per kelvin cal/(kg.k)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per kelvin (cal/g.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'joules per kilogram per celsius J/(kg·°C)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'joules per gram per celsius J/(g·°C)') {
										$heat_capacity = $heat_capacity / 1;
									} elseif ($s_heat_units == 'calories per kilogram per celsius cal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per celsius cal/(g·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									}
								}
								if (isset($t_c_units)) {
									if ($t_c_units == 'Fahrenheit °F') {
										$temp_change = $temp_change / (-457.9);
									} else if ($t_c_units == 'celsius °C') {
										$temp_change = $temp_change / (-272.15);
									}
								}
								$time_of_is = $mass * $heat_capacity * $temp_change / $energy;
							} else {
                                $this->param['error'] = 'Please! Check Your Input.';
                                return $this->param;
							}
						} elseif ($type == 'i_f_temp') {
							if (is_numeric($energy) && is_numeric($mass) && is_numeric($heat_capacity) && is_numeric($in_temp) && is_numeric($s_fin_temp)) {
								if (isset($units)) {
									$unit = $units;
									if ($unit == 'nanojoules (nj)') {
										$energy = $energy / 1000000000;
									} else if ($unit == 'microjoules (μJ)') {
										$energy = $energy / 1000000;
									} else if ($unit == 'millijoules (mJ)') {
										$energy = $energy / 1000;
									} else if ($unit == 'kilojoules (kJ)') {
										$energy = $energy * 1000;
									} else if ($unit == 'megajoules (MJ)') {
										$energy = $energy * 1000000;
									} else if ($unit == 'watt hours (Wh)') {
										$energy = $energy * 3600;
									} else if ($unit == 'kilowatt hours (kWh)') {
										$energy = $energy * 3600000;
									} else if ($unit == 'foot-pounds (ft-lbs)') {
										$energy = $energy * 1.3558;
									} else if ($unit == 'calories (cal)') {
										$energy = $energy * 4.184;
									} else if ($unit == 'kilocalories (Kcal)') {
										$energy = $energy * 4184;
									} else if ($unit == 'megacalories (Mcal)') {
										$energy = $energy * 4184000;
									} else if ($unit == 'nanoelectronovolts (neV)') {
										$energy = $energy / 6241509074460762607776240981;
									} else if ($unit == 'microelectronovolts (μeV)') {
										$energy = $energy / 6241509074460762607776241;
									} else if ($unit == 'millielectronovolts (meV)') {
										$energy = $energy * 1.60218E-22;
									} else if ($unit == 'electronvolts (eV)') {
										$energy = $energy / 6.242e+18;
									} else if ($unit == 'kiloelectronovolts (KeV)') {
										$energy = $energy / 6.242e+15;
									} else if ($unit == 'megaelectronovolts (MeV)') {
										$energy = $energy * 1.6022E-13;
									}
								}
								if (isset($m_units)) {
									if ($m_units == 'picograms (pg)') {
										$mass = $mass / 1000000000000;
									} else if ($m_units == 'nanograms (ng)') {
										$mass = $mass / 1000000000;
									} else if ($m_units == 'micrograms (μg)') {
										$mass = $mass / 1000000;
									} else if ($m_units == 'milligrams (mg)') {
										$mass = $mass / 1000;
									} else if ($m_units == 'decagrams (dag)') {
										$mass = $mass / 0.1;
									} else if ($m_units == 'kilograms (kg)') {
										$mass = $mass / 0.001;
									} else if ($m_units == 'metric tons (t)') {
										$mass = $mass / 0.000001;
									} else if ($m_units == 'grains (gr)') {
										$mass = $mass / 15.432;
									} else if ($m_units == 'drachms (dr)') {
										$mass = $mass / 0.5644;
									} else if ($m_units == 'ounces (oz)') {
										$mass = $mass / 0.035274;
									} else if ($m_units == 'pounds (lb)') {
										$mass = $mass / 0.0022046;
									} else if ($m_units == 'stones (stone)') {
										$mass = $mass / 0.00015747;
									} else if ($m_units == 'US short tones (US ton)') {
										$mass = $mass / 0.0000011023;
									} else if ($m_units == 'imperial tons (Long ton)') {
										$mass = $mass / 0.0000009842;
									} else if ($m_units == 'atomic mass unit (u)') {
										$mass = $mass / 602214000000000000000000;
									} else if ($m_units == 'troy ounce (oz t)') {
										$mass = $mass / 0.03215;
									}
								}
								if (isset($s_heat_units)) {
									if ($s_heat_units == 'joules per kilogram per kelvin J/(kg.k)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'calories per kilogram per kelvin cal/(kg.k)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per kelvin (cal/g.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per kelvin kcal/(kg.k)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'joules per kilogram per celsius J/(kg·°C)') {
										$heat_capacity = $heat_capacity / 1000;
									} elseif ($s_heat_units == 'joules per gram per celsius J/(g·°C)') {
										$heat_capacity = $heat_capacity / 1;
									} elseif ($s_heat_units == 'calories per kilogram per celsius cal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 238.9;
									} elseif ($s_heat_units == 'calories per gram per celsius cal/(g·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									} elseif ($s_heat_units == 'kilocalories per kilogram per celsius kcal/(kg·°C)') {
										$heat_capacity = $heat_capacity / 0.2389;
									}
								}
								if (isset($i_t_units)) {
									if ($i_t_units == 'Fahrenheit °F') {
										$in_temp = $in_temp / (-457.9);
									} else if ($i_t_units == 'celsius °C') {
										$in_temp = $in_temp / (-272.15);
									}
								}
								if (isset($f_t_units)) {
									if ($f_t_units == 'Fahrenheit °F') {
										$fin_temp = $fin_temp / (-457.9);
									} else if ($f_t_units == 'celsius °C') {
										$fin_temp = $fin_temp / (-272.15);
									}
								}

								$temp_change = $s_fin_temp - $in_temp;
								$time_of_is = $mass * $heat_capacity * $temp_change / $energy;
							} else {
                                $this->param['error'] = 'Please! Check Your Input.';
                                return $this->param;
							}
						}
					}
				}
			}
		} else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
		}

		if ($state_change == 'a chemical reaction in a cofee cup calorimeter') {
			$this->param['formula'] = $formula;


			if ($formula == 'Heat Energy') {
				$this->param['mass'] = $mass;
				$this->param['heat_capacity'] = $heat_capacity;
				$this->param['in_temp'] = $in_temp;
				$this->param['fin_temp'] = $s_fin_temp;
				$this->param['temp_change'] = $temp_change;
				$this->param['energy'] = $energy;

				$this->param['units'] = $units;
				$this->param['s_heat_units'] = $s_heat_units;
				$this->param['t_c_units'] = $t_c_units;
				$this->param['i_t_units'] = $i_t_units;
				$this->param['S_f_t_units'] = $S_f_t_units;
			} elseif ($formula == 'Specific Heat') {
				$this->param['energy'] = $energy;
				$this->param['mass'] = $mass;
				$this->param['in_temp'] = $in_temp;
				$this->param['fin_temp'] = $s_fin_temp;
				$this->param['temp_change'] = $temp_change;
				$this->param['heat_capacity'] = $heat_capacity;

				$this->param['units'] = $units;
				$this->param['m_units'] = $m_units;
				$this->param['t_c_units'] = $t_c_units;
				$this->param['i_t_units'] = $i_t_units;
				$this->param['S_f_t_units'] = $S_f_t_units;
			} elseif ($formula == 'Mass') {
				$this->param['energy'] = $energy;
				$this->param['heat_capacity'] = $heat_capacity;
				$this->param['in_temp'] = $in_temp;
				$this->param['fin_temp'] = $s_fin_temp;
				$this->param['temp_change'] = $temp_change;
				$this->param['mass'] = $mass;

				$this->param['units'] = $units;
				$this->param['s_heat_units'] = $s_heat_units;
				$this->param['t_c_units'] = $t_c_units;
				$this->param['i_t_units'] = $i_t_units;
				$this->param['S_f_t_units'] = $S_f_t_units;
			} elseif ($formula == 'Initial_Temperature') {
				$this->param['energy'] = $energy;
				$this->param['mass'] = $mass;
				$this->param['heat_capacity'] = $heat_capacity;
				$this->param['fin_temp'] = $s_fin_temp;
				$this->param['in_temp'] = $in_temp;

				$this->param['units'] = $units;
				$this->param['m_units'] = $m_units;
				$this->param['s_heat_units'] = $s_heat_units;
				$this->param['S_f_t_units'] = $S_f_t_units;
			} elseif ($formula == 'Final_Temperature') {
				$this->param['energy'] = $energy;
				$this->param['mass'] = $mass;
				$this->param['heat_capacity'] = $heat_capacity;
				$this->param['in_temp'] = $in_temp;
				$this->param['fin_temp'] = $fin_temp;

				$this->param['units'] = $units;
				$this->param['m_units'] = $m_units;
				$this->param['s_heat_units'] = $s_heat_units;
				$this->param['i_t_units'] = $i_t_units;
			} elseif ($formula == 'Time_of_isolation') {
				$this->param['energy'] = $energy;
				$this->param['mass'] = $mass;
				$this->param['heat_capacity'] = $heat_capacity;
				$this->param['in_temp'] = $in_temp;
				$this->param['fin_temp'] = $s_fin_temp;
				$this->param['temp_change'] = $temp_change;
				$this->param['time_of_is'] = $time_of_is;

				$this->param['units'] = $units;
				$this->param['m_units'] = $m_units;
				$this->param['s_heat_units'] = $s_heat_units;
				$this->param['t_c_units'] = $t_c_units;
				$this->param['i_t_units'] = $i_t_units;
				$this->param['S_f_t_units'] = $S_f_t_units;
			} elseif ($formula == 'Enthalpy_change') {
				$this->param['energy'] = $energy;
				$this->param['molar_mass'] = $molar_mass;
				$this->param['subtance_mass'] = $subtance_mass;
				$this->param['enthalpy_change'] = $enthalpy_change;
				$this->param['enthalpy_change_2'] = $enthalpy_change_2;

				$this->param['units'] = $units;
				$this->param['s_m_units'] = $s_m_units;
			}
		} else {

			if ($obj_units == '2') {
				if ($state == 'No') {

					$this->param['formula_2obj'] = $formula_2obj;
					$this->param['mass_1'] = $mass_1;
					$this->param['mass_2'] = $mass_2;
					$this->param['heat_capacity_2'] = $heat_capacity_2;
					$this->param['fin_temp_2'] = $fin_temp_2;
					$this->param['in_temp_2'] = $in_temp_2;
					$this->param['heat_capacity_1'] = $heat_capacity_1;
					$this->param['fin_temp_1'] = $fin_temp_1;
					$this->param['in_temp_1'] = $in_temp_1;
					$this->param['energy'] = $energy;
				} elseif ($state == 'Yes,two times') {
					$this->param['two_time'] = $two_time;
					$this->param['mass_1'] = $mass_1;
					$this->param['mass_2'] = $mass_2;
					$this->param['heat_capacity_2'] = $heat_capacity_2;
					$this->param['fin_temp'] = $fin_temp;
					$this->param['in_temp_2'] = $in_temp_2;
					$this->param['heat_capacity_1'] = $heat_capacity_1;
					$this->param['fin_temp_1'] = $fin_temp_1;
					$this->param['in_temp_1'] = $in_temp_1;
					$this->param['energy'] = $energy;

					if ($two_time == 'm1_two') {
						$this->param['div'] = $div;
						$this->param['c2_tf_tfusion'] = $c2_tf_tfusion;
						$this->param['c1_tfusion_ti'] = $c1_tfusion_ti;
						$this->param['m2c2tfti2'] = $m2c2tfti2;
						$this->param['t_fusion'] = $t_fusion;
						$this->param['h_fusion'] = $h_fusion;
						$this->param['fin_temp'] = $fin_temp;
						$this->param['fin_temp_2'] = $fin_temp_2;
					} elseif ($two_time == 'c1_two') {
						$this->param['m1Hfusion'] = $m1Hfusion;
						$this->param['m1c2_Tf_Tfusion'] = $m1c2_Tf_Tfusion;
						$this->param['m2c2_tf_ti'] = $m2c2_tf_ti;
						$this->param['m1_tfusion_ti'] = $m1_tfusion_ti;
						$this->param['t_fusion'] = $t_fusion;
						$this->param['h_fusion'] = $h_fusion;
						$this->param['res'] = $res;
					} elseif ($two_time == 'Ti(1)') {
						$this->param['t_fusion'] = $t_fusion;
						$this->param['h_fusion'] = $h_fusion;
						$this->param['m1Hfusion'] = $m1Hfusion;
						$this->param['m1c2_Tf_Tfusion'] = $m1c2_Tf_Tfusion;
						$this->param['m2c2_tf_ti'] = $m2c2_tf_ti;
						$this->param['m1_c1'] = $m1_c1;
						$this->param['res'] = $res;
					} elseif ($two_time == 'Tfusion') {
						$this->param['m1Hfusion'] = $m1Hfusion;
						$this->param['m2c2_tf_ti'] = $m2c2_tf_ti;
						$this->param['m1c1Ti'] = $m1c1Ti;
						$this->param['m1c2Tf'] = $m1c2Tf;
						$this->param['m1c1'] = $m1c1;
						$this->param['m1c2'] = $m1c2;
						$this->param['res'] = $res;
						$this->param['m1c1_m1c2'] = $m1c1_m1c2;
						$this->param['h_fusion'] = $h_fusion;
						$this->param['t_fusion'] = $t_fusion;
					} elseif ($two_time == 'ΔHfusion') {
						$this->param['Tfusion_ti'] = $Tfusion_ti;
						$this->param['m1_c1'] = $m1_c1;
						$this->param['fin_temp'] = $fin_temp;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m1c2'] = $m1c2;
						$this->param['tf_ti'] = $tf_ti;
						$this->param['m2c2'] = $m2c2;
						$this->param['res'] = $res;
						$this->param['t_fusion'] = $t_fusion;
						$this->param['h_fusion'] = $h_fusion;
					} elseif ($two_time == 'c2') {

						$this->param['Tfusion_ti'] = $Tfusion_ti;
						$this->param['m1_c1'] = $m1_c1;
						$this->param['m1_c1_tfusion_ti'] = $m1_c1_tfusion_ti;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['tf_ti'] = $tf_ti;
						$this->param['t_fusion'] = $t_fusion;
						$this->param['h_fusion'] = $h_fusion;
						$this->param['fin_temp'] = $fin_temp;
						$this->param['in_temp_1'] = $in_temp_1;
						$this->param['m1_tf_tfusion'] = $m1_tf_tfusion;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m2_tf_ti'] = $m2_tf_ti;
						$this->param['heat_capacity_2'] = $heat_capacity_2;
					} elseif ($two_time == 'm2') {

						$this->param['heat_capacity_1'] = $heat_capacity_1;
						$this->param['t_fusion'] = $t_fusion;
						$this->param['in_temp_1'] = $in_temp_1;
						$this->param['mass_1'] = $mass_1;
						$this->param['h_fusion'] = $h_fusion;
						$this->param['heat_capacity_2'] = $heat_capacity_2;
						$this->param['fin_temp'] = $fin_temp;
						$this->param['in_temp_2'] = $in_temp_2;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m1_c1'] = $m1_c1;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['mass_2'] = $mass_2;
						$this->param['res'] = $res;
						$this->param['m1_c1_tfusion_ti'] = $m1_c1_tfusion_ti;
						$this->param['m1_c2_tf_tfusion'] = $m1_c2_tf_tfusion;
						$this->param['c2_tf_ti'] = $c2_tf_ti;
					} elseif ($two_time == 'Ti(2)') {

						$this->param['mass_1'] = $mass_1;
						$this->param['heat_capacity_1'] = $heat_capacity_1;
						$this->param['t_fusion'] = $t_fusion;
						$this->param['in_temp_1'] = $in_temp_1;
						$this->param['h_fusion'] = $h_fusion;
						$this->param['heat_capacity_2'] = $heat_capacity_2;
						$this->param['fin_temp'] = $fin_temp;
						$this->param['mass_2'] = $mass_2;
						$this->param['m1_h1_tfusion_intemp'] = $m1_h1_tfusion_intemp;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1c2_tf_tfusion'] = $m1c2_tf_tfusion;
						$this->param['m1_h1'] = $m1_h1;
						$this->param['m2c2'] = $m2c2;
						$this->param['res'] = $res;
						$this->param['in_temp_2'] = $in_temp_2;
					} elseif ($two_time == 'Tf') {
						$this->param['m1c1tfti'] = $m1c1tfti;
						$this->param['m1Hfusion'] = $m1Hfusion;
						$this->param['m1c1Tfusion'] = $m1c1Tfusion;
						$this->param['m2c2Ti2'] = $m2c2Ti2;
						$this->param['m1c2'] = $m1c2;
						$this->param['m2c2'] = $m2c2;
						$this->param['t_fusion'] = $t_fusion;
						$this->param['h_fusion'] = $h_fusion;
					}
				}
			} elseif ($obj_units == '3') {
				if ($state == 'No') {

					$this->param['formula_3obj'] = $formula_3obj;

					if ($formula_3obj == 'm1') {
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['c1_tf_ti1'] = $c1_tf_ti1;
						$this->param['m3c3'] = $m3c3;
						$this->param['m3c3_tf_ti3'] = $m3c3_tf_ti3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['res'] = $res;
						$this->param['mass_1'] = $mass_1_3;
					} elseif ($formula_3obj == 'c1') {

						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['mass_1'] = $mass_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;

						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['m1_tf_ti1'] = $m1_tf_ti1;
						$this->param['m2c2tf2ti2'] = $m2c2tf2ti2;
						$this->param['m3c3_tf_ti3'] = $m3c3_tf_ti3;
						$this->param['res'] = $res;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
					} elseif ($formula_3obj == 'Tf(1)') {

						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;

						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m1c1'] = $m1c1;
						$this->param['m2c2tf2ti2'] = $m2c2tf2ti2;
						$this->param['m3c3_tf_ti3'] = $m3c3_tf_ti3;
						$this->param['res'] = $res;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
					} elseif ($formula_3obj == 'Ti(1)') {

						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;

						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m1c1'] = $m1c1;
						$this->param['m2c2tf2ti2'] = $m2c2tf2ti2;
						$this->param['m3c3_tf_ti3'] = $m3c3_tf_ti3;
						$this->param['res'] = $res;
						$this->param['in_temp_1'] = $in_temp_1_3;
					} elseif ($formula_3obj == 'm2') {

						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['tf2ti2'] = $tf2ti2;
						$this->param['c2tf2ti2'] = $c2tf2ti2;
						$this->param['m1c1tf1ti1'] = $m1c1tf1ti1;
						$this->param['m3c3_tf_ti3'] = $m3c3_tf_ti3;
						$this->param['res'] = $res;
						$this->param['mass_2'] = $mass_2_3;
					} elseif ($formula_3obj == 'c2') {

						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['tf2ti2'] = $tf2ti2;
						$this->param['m2tf2ti2'] = $m2tf2ti2;
						$this->param['m1c1tf1ti1'] = $m1c1tf1ti1;
						$this->param['m3c3_tf_ti3'] = $m3c3_tf_ti3;
						$this->param['res'] = $res;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
					} elseif ($formula_3obj == 'Tf(2)') {

						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m1c1tf1ti1'] = $m1c1tf1ti1;
						$this->param['m3c3_tf_ti3'] = $m3c3_tf_ti3;
						$this->param['res'] = $res;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
					} elseif ($formula_3obj == 'Ti(2)') {

						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m1c1tf1ti1'] = $m1c1tf1ti1;
						$this->param['m3c3_tf_ti3'] = $m3c3_tf_ti3;
						$this->param['m3c3_tf_ti3_tf2'] = $m3c3_tf_ti3_tf2;
						$this->param['m2c2'] = $m2c2;
						$this->param['res'] = $res;
						$this->param['in_temp_2'] = $in_temp_2_3;
					} elseif ($formula_3obj == 'm3') {

						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['c3tf3ti3'] = $c3tf3ti3;

						$this->param['m1c1tf1ti1'] = $m1c1tf1ti1;
						$this->param['m2c2tf2ti2'] = $m2c2tf2ti2;

						$this->param['res'] = $res;
						$this->param['mass_3'] = $mass_3_3;
					} elseif ($formula_3obj == 'c3') {

						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;

						$this->param['m1c1'] = $m1c1;

						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m1c1tf1ti1'] = $m1c1tf1ti1;
						$this->param['m2c2tf2ti2'] = $m2c2tf2ti2;
						$this->param['m3tf3ti3'] = $m3tf3ti3;

						$this->param['res'] = $res;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
					} elseif ($formula_3obj == 'Tf(3)') {

						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m2c2tf2ti2'] = $m2c2tf2ti2;
						$this->param['m1c1tf1ti1'] = $m1c1tf1ti1;
						$this->param['m2c2tf2ti2ti3'] = $m2c2tf2ti2ti3;
						$this->param['m3c3'] = $m3c3;
						$this->param['res'] = $res;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
					} elseif ($formula_3obj == 'Ti(3)') {

						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['fin_temp_1'] = $fin_temp_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp_2'] = $fin_temp_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['fin_temp_3'] = $fin_temp_3_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tf_ti1'] = $tf_ti1;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m2c2tf2ti2'] = $m2c2tf2ti2;
						$this->param['m1c1tf1ti1'] = $m1c1tf1ti1;
						$this->param['m2c2tf2ti2ti3'] = $m2c2tf2ti2ti3;
						$this->param['m3c3'] = $m3c3;
						$this->param['res'] = $res;
						$this->param['in_temp_3'] = $in_temp_3_3;
					}
				} elseif ($state == 'Yes,two times') {
					$this->param['three_time'] = $three_time;

					if ($three_time == 'm1') {
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['in_temp_3'] = $in_temp_3_3;

						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m2c2tfti2'] = $m2c2tfti2;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m3c3tfti3'] = $m3c3tfti3;
						$this->param['tfusion_ti'] = $tfusion_ti;
						$this->param['c1_tfusion_ti'] = $c1_tfusion_ti;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['c2_tf_tfusion'] = $c2_tf_tfusion;
						$this->param['m2c2tf2ti2_m3c3tfti3'] = $m2c2tf2ti2_m3c3tfti3;
						$this->param['c1tfusionti1_hfusion_c2tftfusion'] = $c1tfusionti1_hfusion_c2tftfusion;
						$this->param['mass_1'] = $mass_1_3;
					} elseif ($three_time == 'c1') {
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['in_temp_3'] = $in_temp_3_3;

						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m1c2tftfuion'] = $m1c2tftfuion;
						$this->param['m2c2tfti2'] = $m2c2tfti2;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m3c3'] = $m3c3;
						$this->param['m3c3tfti3'] = $m3c3tfti3;
						$this->param['tfusion_ti1'] = $tfusion_ti1;
						$this->param['m1tfusionti1'] = $m1tfusionti1;
						$this->param['res'] = $res;
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
					} elseif ($three_time == 'Tfusion') {
						$this->param['mass_2'] = $mass_2_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['mass_1'] = $mass_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['in_temp_1'] = $in_temp_1_3;

						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m2c2tfti2'] = $m2c2tfti2;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m3c3tfti3'] = $m3c3tfti3;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1c1ti1'] = $m1c1ti1;
						$this->param['m1c2tf'] = $m1c2tf;
						$this->param['m1c1'] = $m1c1;
						$this->param['m1c2'] = $m1c2;
						$this->param['div'] = $div;
						$this->param['res'] = $res;
						$this->param['t_fusion'] = $t_fusion_3;
					} elseif ($three_time == 'Ti(1)') {
						$this->param['mass_1'] = $mass_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;

						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1c2'] = $m1c2;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m1c2tftfuion'] = $m1c2tftfuion;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m2c2tfti2'] = $m2c2tfti2;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m3c3tfti3'] = $m3c3tfti3;
						$this->param['m1c1tfusion'] = $m1c1tfusion;
						$this->param['m1c1'] = $m1c1;
						$this->param['res'] = $res;
						$this->param['in_temp_1'] = $in_temp_1_3;
					} elseif ($three_time == 'Hfusion') {
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tfusionti1'] = $tfusionti1;
						$this->param['m1c2'] = $m1c2;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m1c1tfusionti1'] = $m1c1tfusionti1;
						$this->param['m1c2tftfusion'] = $m1c2tftfusion;
						$this->param['m2c2tfti2'] = $m2c2tfti2;
						$this->param['m3c3tfti3'] = $m3c3tfti3;
						$this->param['res'] = $res;
						$this->param['h_fusion'] = $h_fusion_3;
					} elseif ($three_time == 'c2') {
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;

						$this->param['heat_capacity_2'] = $heat_capacity_2_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tfusionti1'] = $tfusionti1;
						$this->param['m1c1tfusionti1'] = $m1c1tfusionti1;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m3c3tfti3'] = $m3c3tfti3;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m1tftfusion'] = $m1tftfusion;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m2tfti2'] = $m2tfti2;
						$this->param['div'] = $div;
						$this->param['res'] = $res;
					} elseif ($three_time == 'm2') {
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['in_temp_2'] = $in_temp_2_3;

						$this->param['mass_2'] = $mass_2_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tfusionti1'] = $tfusionti1;
						$this->param['m1c1tfusionti1'] = $m1c1tfusionti1;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1c2'] = $m1c2;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m1c2tftfuion'] = $m1c2tftfuion;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m3c3tfti3'] = $m3c3tfti3;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['c2tfti2'] = $c2tfti2;
						$this->param['res'] = $res;
					} elseif ($three_time == 'Ti(2)') {
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;
						$this->param['mass_2'] = $mass_2_3;

						$this->param['in_temp_2'] = $in_temp_2_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tfusionti1'] = $tfusionti1;
						$this->param['m1c1tfusionti1'] = $m1c1tfusionti1;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1c2'] = $m1c2;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m1c2tftfuion'] = $m1c2tftfuion;
						$this->param['m3c3'] = $m3c3;
						$this->param['tf_ti3'] = $tf_ti3;
						$this->param['m3c3tfti3'] = $m3c3tfti3;
						$this->param['m2c2tf'] = $m2c2tf;
						$this->param['m2c2'] = $m2c2;
						$this->param['res'] = $res;
					} elseif ($three_time == 'm3') {
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;

						$this->param['mass_3'] = $mass_3_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tfusionti1'] = $tfusionti1;
						$this->param['m1c1tfusionti1'] = $m1c1tfusionti1;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1c2'] = $m1c2;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m1c2tftfuion'] = $m1c2tftfuion;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m2c2tfti2'] = $m2c2tfti2;
						$this->param['tfti3'] = $tfti3;
						$this->param['c3tfti3'] = $c3tfti3;
						$this->param['res'] = $res;
					} elseif ($three_time == 'c3') {
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['fin_temp'] = $fin_temp_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;

						$this->param['mass_3'] = $mass_3_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tfusionti1'] = $tfusionti1;
						$this->param['m1c1tfusionti1'] = $m1c1tfusionti1;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1c2'] = $m1c2;
						$this->param['tf_tfusion'] = $tf_tfusion;
						$this->param['m1c2tftfuion'] = $m1c2tftfuion;
						$this->param['m2c2'] = $m2c2;
						$this->param['tf_ti2'] = $tf_ti2;
						$this->param['m2c2tfti2'] = $m2c2tfti2;
						$this->param['tfti3'] = $tfti3;
						$this->param['m3tfti3'] = $m3tfti3;
						$this->param['res'] = $res;
					} elseif ($three_time == 'Tf') {
						$this->param['mass_1'] = $mass_1_3;
						$this->param['heat_capacity_1'] = $heat_capacity_1_3;
						$this->param['t_fusion'] = $t_fusion_3;
						$this->param['in_temp_1'] = $in_temp_1_3;
						$this->param['h_fusion'] = $h_fusion_3;
						$this->param['heat_capacity_2'] = $heat_capacity_2_3;
						$this->param['mass_2'] = $mass_2_3;
						$this->param['in_temp_2'] = $in_temp_2_3;
						$this->param['mass_3'] = $mass_3_3;
						$this->param['heat_capacity_3'] = $heat_capacity_3_3;
						$this->param['in_temp_3'] = $in_temp_3_3;

						$this->param['fin_temp'] = $fin_temp_3;

						$this->param['m1c1'] = $m1c1;
						$this->param['tfusionti1'] = $tfusionti1;
						$this->param['m1c1tfusionti1'] = $m1c1tfusionti1;
						$this->param['m1hfusion'] = $m1hfusion;
						$this->param['m1c2tfusion'] = $m1c2tfusion;
						$this->param['m2c2ti2'] = $m2c2ti2;
						$this->param['m3c3Ti3'] = $m3c3Ti3;
						$this->param['m1c2'] = $m1c2;
						$this->param['m2c2'] = $m2c2;
						$this->param['m3c3'] = $m3c3;
						$this->param['m1c2m2c2m3c3'] = $m1c2m2c2m3c3;
						$this->param['res'] = $res;
					}
				}
			} else {
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
			}
		}

		$this->param['RESULT'] = 1;
        return $this->param;
	}

    // STP Calculator
    public function stp($request){
        $volume = $request->volume;
        $volume_units = $request->volume_units;
        $temp = $request->temp;
        $temp_units = $request->temp_units;
        $pressure = $request->pressure;
        $pressure_units = $request->pressure_units;

        if (is_numeric($volume) && is_numeric($temp) && is_numeric($pressure)) {
            if (isset($volume_units)) {
                if ($volume_units == 'mm³') {
                    $volume = $volume * 0.000001;
                } else if ($volume_units == 'cm³') {
                    $volume = $volume * 0.001;
                } else if ($volume_units == 'dm³') {
                    $volume = $volume * 1;
                } else if ($volume_units == 'm³') {
                    $volume = $volume * 1000;
                } else if ($volume_units == 'cu in') {
                    $volume = $volume * 0.016387;
                } else if ($volume_units == 'cu ft') {
                    $volume = $volume * 28.317;
                } else if ($volume_units == 'cu yd') {
                    $volume = $volume * 764.6;
                } else if ($volume_units == 'ml') {
                    $volume = $volume * 0.001;
                } else if ($volume_units == 'cl') {
                    $volume = $volume * 0.01;
                }
            }
            if (isset($temp_units)) {
                if ($temp_units == '°F') {
                    $temp = ($temp - 32) * 5 / 9 + 273.15;
                } else if ($temp_units == '°C') {
                    $temp = $temp + 273.15;
                }
            }
            if (isset($pressure_units)) {
                if ($pressure_units == 'Pa') {
                    $pressure = $pressure * 0.0075;
                } else if ($pressure_units == 'bar') {
                    $pressure = $pressure * 750;
                } else if ($pressure_units == 'psi') {
                    $pressure = $pressure * 51.71;
                } else if ($pressure_units == 'at') {
                    $pressure = $pressure * 735.6;
                } else if ($pressure_units == 'atm') {
                    $pressure = $pressure * 760;
                } else if ($pressure_units == 'hPa') {
                    $pressure = $pressure * 0.75;
                } else if ($pressure_units == 'kPa') {
                    $pressure = $pressure * 7.5;
                } else if ($pressure_units == 'MPa') {
                    $pressure = $pressure * 7.5;
                } else if ($pressure_units == 'GPa') {
                    $pressure = $pressure * 7500617;
                } else if ($pressure_units == 'inHg') {
                    $pressure = $pressure * 25.4;
                } else if ($pressure_units == 'mmHg') {
                    $pressure = $pressure * 1;
                }
            }

            $t = 273.15 / $temp;
            $v = $volume * $t;
            $p = $pressure / 760;
            $vstp = $v * $p;
            $moles = $vstp / 22.4;

            $this->param['vstp'] = $vstp;
            $this->param['moles'] = $moles;
            $this->param['volume'] = $volume;
            $this->param['temp'] = $temp;
            $this->param['pressure'] = $pressure;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
        $this->param['RESULT'] = 1;
        return $this->param;
    }

    // CFU Calculator
    public function cfu($request){
        $nc = $request->nc;
        $df = $request->df;
        $volume = $request->volume;
        $volume_units = $request->volume_units;

        if (is_numeric($nc) && is_numeric($df) && is_numeric($volume)) {
            if (isset($volume_units)) {
                if ($volume_units == 'mm³') {
                    $volume = $volume * 0.000000001;
                } else if ($volume_units == 'cm³') {
                    $volume = $volume * 0.000001;
                } else if ($volume_units == 'dm³') {
                    $volume = $volume * 0.001;
                } else if ($volume_units == 'cu in') {
                    $volume = $volume * 0.000016387;
                } else if ($volume_units == 'cu ft') {
                    $volume = $volume * 0.028317;
                } else if ($volume_units == 'cu yd') {
                    $volume = $volume * 0.7646;
                } else if ($volume_units == 'ml') {
                    $volume = $volume * 0.000001;
                } else if ($volume_units == 'cl') {
                    $volume = $volume * 0.00001;
                } else if ($volume_units == 'l') {
                    $volume = $volume * 0.001;
                }
            }

            $res = $nc * $df;
            $cfu = $res / $volume;

            $this->param['nc'] = $nc;
            $this->param['df'] = $df;
            $this->param['volume'] = $volume;
            $this->param['res'] = $res;
            $this->param['cfu'] = $cfu;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
        $this->param['RESULT'] = 1;
        return $this->param;
    }

    // ML to Moles Calculator
    public function ml($request){
		//  dd($request->all());
        $volume = $request->volume;
        $volume_unit = $request->volume_unit;
        $molarity = $request->molarity;
        $molarity_unit = $request->molarity_unit;


		if($volume_unit == 'mL'){
			$volume_unit  = '1';
		}else if($volume_unit == 'L'){
			$volume_unit  = '2';
		}else if($volume_unit == 'uL'){
			$volume_unit  = '3';
		}

		if($molarity_unit == 'M'){
			$molarity_unit  = '1';
		}else if($molarity_unit == 'mM'){
			$molarity_unit  = '2';
		}else if($molarity_unit == 'uM'){
			$molarity_unit  = '3';
		}

        function volume_unit($a, $b){
            if ($b == "1") {
                $vol_u = $a / 1000;
            } else if ($b == "2") {
                $vol_u = $a * 1;
            } else if ($b == "3") {
                $vol_u = $a * 0.000001;
            }
            return $vol_u;
        }
        function molarity_unit($a, $b){
            if ($b == "1") {
                $mol_u = $a * 1;
            } else if ($b == "2") {
                $mol_u = $a / 1000;
            } else if ($b == "3") {
                $mol_u = $a / 1000000;
            }
            return $mol_u;
        }
        if (is_numeric($volume) && is_numeric($molarity)) {
            $volume = volume_unit($volume, $volume_unit);
            $molarity = molarity_unit($molarity, $molarity_unit);
            $answer = $volume * $molarity;
            $this->param = array(
                "answer"             => $answer,
                "RESULT"             => 1
            );
            return $this->param;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Mmol to Mg/dl Calculator
    public function mmol($request){
        $solve = $request->solve;
        $input = $request->input;

        if (is_numeric($input)) {
            if ($solve === "1") {
                $answer = $input * 18;
            } else {
                $answer = $input / 18;
            }
            $this->param = array(
                "answer"             => $answer,
                "RESULT"             => 1
            );
            return $this->param;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Activation Energy Calculator
    public function activation($request){
        $temperature = $request->temperature;
        $rate = $request->rate;
        $const = $request->const;
        $tempUnit = $request->tempUnit;
        $rateUnits = $request->rateUnits;
        $constUnits = $request->constUnits;

        function convertToPerSecond($value, $unit){
            if ($unit === 'sec') {
                $input = $value;
            } elseif ($unit === 'min') {
                $input = $value * 60;
            } elseif ($unit === 'hour') {
                $input = $value * 3600;
            } elseif ($unit === 'day') {
                $input = $value * 86400;
            } elseif ($unit === 'week') {
                $input = $value * 86400 * 7;
            } elseif ($unit === 'month') {
                $input = $value * (30 * 86400);
            } elseif ($unit === 'year') {
                $input = $value * (365.25 * 24 * 3600);
            }
            return $input;
        }

        if (is_numeric($temperature) && is_numeric($rate) && is_numeric($const)) {
            if (isset($tempUnit)) {
                if ($tempUnit == "fahrenheit") {
                    $temperature = ($temperature - 32) * 5 / 9 + 273.15;
                } else if ($tempUnit == "celsius") {
                    $temperature = $temperature + 273.15;
                }
            }
            if (isset($rate)) {
                $rate = convertToPerSecond($rate, $rateUnits);
            }
            if (isset($const)) {
                $const = convertToPerSecond($const, $constUnits);
            }

            // Activation energy formula calculation
            $x = -0.008314 * $temperature;

            $log = log($rate / $const);
            $res = $x * $log;
            // other unit results
            $joule = $res * 1000;
            $megajoule = $res * 0.001;
            $calories = $res * 239;
            $kilocalories = $res * 0.239;

            // echo $res;die;
            $this->param['temperature'] = $temperature;
            $this->param['log'] = $log;
            $this->param['rate'] = $rate;
            $this->param['const'] = $const;
            $this->param['res'] = $res;
            $this->param['joule'] = $joule;
            $this->param['megajoule'] = $megajoule;
            $this->param['calories'] = $calories;
            $this->param['kilocalories'] = $kilocalories;
            $this->param['RESULT'] = 1;
            return $this->param;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Average Atomic Mass Calculator
    public function average($request){
		// dd($request->all());
        $isotopes_no = $request->isotopes_no;
        $per = $request->per;
        $per_unit = $request->per_unit;
        $mass = $request->mass;
        
        if (isset($per) && isset($per_unit) && isset($mass) && is_numeric($isotopes_no)) {
            for ($i = 0; $i < $isotopes_no; $i++) {
                if (isset($per_unit[$i]) && is_numeric($per[$i]) && is_numeric($mass[$i])) {
                    if ($per_unit[$i] == "decimal") {
                        $abundance = $per[$i];
                    } else {
                        $abundance = $per[$i] / 100;
                    }

                    $am_array[$i] = $mass[$i] * $abundance;
                } else {
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            }
            $amSum = array_sum($am_array);

            // $this->param['per']    = $per;
            // $this->param['mass']   = $mass;
            $this->param['amSum']  = $amSum;
            $this->param['RESULT'] = 1;
            return $this->param;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Bond Order Calculator
    public function bond($request){
        $solve = $request->solve;
        $f_input = $request->f_input;
        $s_input = $request->s_input;

        if (is_numeric($f_input) && is_numeric($s_input)) {
            if ($solve === "1") {
                $answer = 0.5 * ($f_input - $s_input);
            } elseif ($solve === "2") {
                $answer = (2 * $f_input) + $s_input;
            } else {
                $answer = (($f_input * 2) - $s_input) * (-1);
            }
            $this->param = array(
                "answer"             => $answer,
                "RESULT"             => 1
            );
            return $this->param;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Gibbs Free Energy Calculator
    public function gibbs($request){
		//  dd($request->all());
        $entropy = $request->entropy;
        $enthalpy = $request->enthalpy;
        $temperature = $request->temperature;
        $enthalpy_units = $request->enthalpy_units;
        $entropy_units = $request->entropy_units;
        $t_units = $request->t_units;

        if (isset($entropy_units)) {
            if ($entropy_units == "KJ") {
                $entropy = $entropy;
            } else if ($entropy_units == "cal") {
                $entropy = $entropy * 0.004184;
            } else if ($entropy_units == "kcal") {
                $entropy = $entropy * 4.184;
            } else if ($entropy_units == "J") {
                $entropy = $entropy * 0.001;
            }
        }
        if (isset($enthalpy_units)) {
            if ($enthalpy_units == "KJ") {
                $enthalpy = $enthalpy;
            } else if ($enthalpy_units == "cal") {
                $enthalpy = $enthalpy * 0.004184;
            } else if ($enthalpy_units == "kcal") {
                $enthalpy = $enthalpy * 4.184;
            } else if ($enthalpy_units == "J") {
                $enthalpy = $enthalpy * 0.001;
            }
        }
        if (isset($t_units)) {
            if ($t_units == "°F") {
                $temperature = ($temperature - 32) * 5 / 9 + 273.15;
            } else if ($t_units == "°C") {
                $temperature = $temperature + 273.15;
            }
        }
        if (is_numeric($enthalpy) && is_numeric($entropy) && is_numeric($temperature)) {
            $gibbs_free_energy = ($enthalpy * 1000) - ($temperature * $entropy * 1000);
            $gibbs = $gibbs_free_energy / 1000;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
        $this->param['gibbs'] = $gibbs;
        $this->param['RESULT'] = 1;
        return $this->param;
    }

    // Vapor Pressure Calculator
    public function vapor($request){
		//  dd($request->all());
        $t1 = $request->t1;
        $t1_units = $request->t1_units;
        $t2 = $request->t2;
        $t2_units = $request->t2_units;
        $p1 = $request->p1;
        $p1_units = $request->p1_units;
        $deltaHvap = $request->deltaHvap;
        $deltaHvap_units = $request->deltaHvap_units;
        $p_sol = $request->p_sol;
        $p_sol_units = $request->p_sol_units;
        $x_sol = $request->x_sol;

        function convertToKelvin($value, $unit){
            if ($unit == '°C') {
                return $value + 273.15;
            } elseif ($unit == '°F') {
                return ($value - 32) * 5 / 9 + 273.15;
            } elseif ($unit == 'k') {
                return $value;
            } elseif ($unit == '°R') {
                return $value * 5 / 9;
            } elseif ($unit == '°De') {
                return 373.15 - ($value * 2 / 3);
            } elseif ($unit == '°N') {
                return ($value * 100 / 33) + 273.15;
            } elseif ($unit == '°Ré') {
                return ($value * 5 / 4) + 273.15;
            } elseif ($unit == '°Rø') {
                return ($value - 7.5) * 40 / 21 + 273.15;
            } else {
                return null; // Invalid unit
            }
        }
        function convertToPascals($value, $unit){
            switch ($unit) {
                case 'Pa':
                    return $value;
                case 'Bar':
                    return $value * 100000;
                case 'psi':
                    return $value * 6894.76;
                case 'at':
                case 'atm':
                    return $value * 101325;
                case 'Torr':
                    return $value * 133.322;
                case 'hPa':
                    return $value * 100;
                case 'kPa':
                    return $value * 1000;
                case 'MPa':
                    return $value * 1000000;
                case 'GPa':
                    return $value * 1000000000;
                default:
                    return null; // Invalid unit
            }
        }
        function convertToJoules($value, $unit){
            switch ($unit) {
                case 'J':
                    return $value;
                case 'KJ':
                    return $value * 1000;
                case 'MJ':
                    return $value * 1000000;
                case 'Wh':
                    return $value * 3600; // 1 Wh = 3600 J
                case 'KWh':
                    return $value * 3.6e6; // 1 KWh = 3.6e6 J
                case 'ft-lb':
                    return $value * 1.35582; // 1 ft-lb ≈ 1.35582 J
                case 'kcal':
                    return $value * 4184; // 1 kcal ≈ 4184 J
                default:
                    return null; // Invalid unit
            }
        }
        if (is_numeric($t1) && is_numeric($t2) && is_numeric($p1) && is_numeric($deltaHvap) && is_numeric($p_sol) && is_numeric($x_sol)) {
            $t1 = convertToKelvin($t1, $t1_units);
            $t2 = convertToKelvin($t2, $t2_units);
            $deltaHvap = convertToJoules($deltaHvap, $deltaHvap_units);
            $p_sol = convertToPascals($p_sol, $p_sol_units);
            $R = 8.314;
            $rightSide = (-$deltaHvap / $R) * (1 / $t2 - 1 / $t1);
            $p2 = $p1 * exp($rightSide);
            $xsolvent = $p_sol  * $x_sol;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
        $this->param['p2'] = $p2;
        $this->param['xsolvent'] = $xsolvent;
        $this->param['RESULT'] = 1;

        return $this->param;
    }

    // Rate Constant Calculator
    public function rate($request){

	    // dd($request->all());
        $unit_x = trim($request->unit_x);
        $module_x = trim($request->module_x);
        $module_y = trim($request->module_y);
        $module_z = trim($request->module_z);
        $unit_a = trim($request->unit_a);
        $unit_b = trim($request->unit_b);
        $unit_c = trim($request->unit_c);
        $time_a = trim($request->time_a);
        $time_b = trim($request->time_b);
        $time_c = trim($request->time_c);
        $half_a = trim($request->half_a);
        $half_b = trim($request->half_b);
        $half_c = trim($request->half_c);
        $con_a = trim($request->con_a);
        $con_b = trim($request->con_b);
        $con_c = trim($request->con_c);


		if($unit_a == 'M'){
			$unit_a = '0';
		}else if($unit_a == 'mM'){
			$unit_a = '1';
		}else if($unit_a == 'μM'){
			$unit_a = '2';
		}else if($unit_a == 'nM'){
			$unit_a = '3';
		}

		if($time_a == 'μs'){
			$time_a = '0';
		}else if($time_a == 'ms'){
			$time_a = '1';
		}else if($time_a == 'sec'){
			$time_a = '2';
		}else if($time_a == 'min'){
			$time_a = '3';
		}else if($time_a == 'min/sec'){
			$time_a = '4';
		}else if($time_a == 'hrs'){
			$unit_a = '6';
		}

	
		if($unit_b == 'M'){
			$unit_b = '0';
		}else if($unit_b == 'mM'){
			$unit_b = '1';
		}else if($unit_b == 'μM'){
			$unit_b = '2';
		}else if($unit_b == 'nM'){
			$unit_b = '3';
		}

		if($time_b == 'μs'){
			$time_b = '0';
		}else if($time_b == 'ms'){
			$time_b = '1';
		}else if($time_b == 'sec'){
			$time_b = '2';
		}else if($time_b == 'min'){
			$time_b = '3';
		}else if($time_b == 'min/sec'){
			$time_b = '4';
		}else if($time_b == 'hrs'){
			$time_b = '6';
		}


		if($unit_c == 'M'){
			$unit_c = '0';
		}else if($unit_c == 'mM'){
			$unit_c = '1';
		}else if($unit_c == 'μM'){
			$unit_c = '2';
		}else if($unit_c == 'nM'){
			$unit_c = '3';
		}

		if($time_c == 'μs'){
			$time_c = '0';
		}else if($time_c == 'ms'){
			$time_c = '1';
		}else if($time_c == 'sec'){
			$time_c = '2';
		}else if($time_c == 'min'){
			$time_c = '3';
		}else if($time_c == 'min/sec'){
			$time_c = '4';
		}else if($time_c == 'hrs'){
			$time_c = '6';
		}

        function calculate($a, $b){
            if ($b == '0') {
                $convert = $a * 1;
            } else if ($b == '1') {
                $convert = $a * 0.001;
            } else if ($b == '2') {
                $convert = $a * 0.000001;
            } else if ($b == '3') {
                $convert = $a * 0.000000001;
            }
            return $convert;
        }
        function calculatet($a, $b){
            if ($b == '0') {
                $convert = $a * 0.000001;
            } else if ($b == '1') {
                $convert = $a * 0.001;
            } else if ($b == '2') {
                $convert = $a * 1;
            } else if ($b == '3') {
                $convert = $a * 60;
            } else if ($b == '4') {
                $convert = $a * 3600;
            }
            return $convert;
        }

        $check = true;
        if ($unit_x == 'uni') {
            if ($module_x == '0') {
                if (is_numeric($con_a) && is_numeric($half_a)) {
                    $conca = calculate($con_a, $unit_a);
                    $htime = calculatet($half_a, $time_a);
                    $k_res = $conca / (2 * $htime);
                    $rate_res = $k_res;
                }else{
                    $check = false;
                }
            } else if ($module_x == '1') {
                if (is_numeric($con_a) && is_numeric($half_a)) {
                    $conca = calculate($con_a, $unit_a);
                    $htime = calculatet($half_a, $time_a);
                    $k_res = 0.693 / $htime;
                    $rate_res = $k_res * $conca;
                    $rate_res = sprintf('%f', $rate_res);
                }else{
                    $check = false;
                }
            } else {
                if (is_numeric($con_a) && is_numeric($half_a)) {
                    $conca = calculate($con_a, $unit_a);
                    $htime = calculatet($half_a, $time_a);
                    $k_res = 1 / ($htime * $conca);
                    $rate_res = $k_res * ($conca * $conca);
                    $rate_res = sprintf('%f', $rate_res);
                }else{
                    $check = false;
                }
            }
        } else if ($unit_x == 'bi') {
            if ($module_x == '1' && $module_y == '1') {
                if (is_numeric($con_a) && is_numeric($half_a)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $htime = calculatet($half_a, $time_b);
                    $k_res = 0.693 / $htime;
                    $rate_res = $k_res * $conca * $concb;
                    $rate_res = number_format($rate_res, 15);
                }else{
                    $check = false;
                }
            } else if ($module_x == '1' && $module_y == '2') {
                if (is_numeric($con_a) && is_numeric($half_a)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $htime = calculatet($half_a, $time_b);
                    $k_res = 0.693 / $htime;
                    $b_res = 1 / ($k_res * $concb);
                    $b_res = number_format($b_res);
                    $rate_res = $k_res * $conca * ($concb * $concb);
                    $rate_res = number_format($rate_res, 15);
                }else{
                    $check = false;
                }
            } else if ($module_x == '2' && $module_y == '1') {
                if (is_numeric($con_a) && is_numeric($half_a)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    // $halfa = calculate($half_a, $time_a);
                    $htime = calculatet($half_a, $time_b);
                    $k_res = 1 / ($conca * $htime);
                    $b_res = 0.693 / $k_res;
                    $b_res = number_format($b_res, 8);
                    $rate_res = $k_res * $concb * ($conca * $conca);
                    $rate_res = number_format($rate_res, 12);
                }else{
                    $check = false;
                }
            }
        } else {
            if ($module_x == '1' && $module_y == '1' && $module_z == '1') {
                if (is_numeric($con_a) && is_numeric($con_b) || is_numeric($con_c) || is_numeric($half_a) && is_numeric($half_b) || is_numeric($half_c)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $concd = calculate($con_c, $unit_c);
                    $htime = calculatet($half_a, $time_a);
                    $k_res = 0.693 / $htime;
                    $rate_res = $k_res * $conca * $concb * $concd;
                    $rate_res = number_format($rate_res, 15);
                }else{
                    $check = false;
                }
            } else if ($module_x == '1' && $module_y == '2' && $module_z == '1') {
                // is k 1st 1st ka half time same rhy ga
                if (is_numeric($con_a) && is_numeric($con_b) || is_numeric($con_c) || is_numeric($half_a) && is_numeric($half_b) || is_numeric($half_c)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $concc = calculate($con_c, $unit_c);
                    $htime = calculatet($half_a, $time_a);
                    $k_res = 0.693 / $htime;
                    $b_res = 1 / ($k_res * $concb);
                    $b_res = number_format($b_res, 5);
                    $rate_res = $k_res * $conca * $concb * $concb * $concc;
                    $rate_res = number_format($rate_res, 15);
                }else{
                    $check = false;
                }
            } else if ($module_x == '1' && $module_y == '1' && $module_z == '2') {
                // is k 1st 1st ka half time same rhy ga
                if (is_numeric($con_a) && is_numeric($con_b) || is_numeric($con_c) || is_numeric($half_a) && is_numeric($half_b) || is_numeric($half_c)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $concc = calculate($con_c, $unit_c);
                    $htime = calculatet($half_a, $time_a);
                    $k_res = 0.693 / $htime;
                    $c_res = 1 / ($k_res * $concc);
                    $c_res = number_format($c_res, 5);
                    $rate_res = $k_res * $conca * $concb * $concc * $concc;
                    $rate_res = number_format($rate_res, 15);
                }else{
                    $check = false;
                }
            } else if ($module_x == '2' && $module_y == '1' && $module_z == '1') {
                // is k 1st 1st ka half time same rhy ga
                if (is_numeric($con_a) && is_numeric($con_b) || is_numeric($con_c) || is_numeric($half_a) && is_numeric($half_b) || is_numeric($half_c)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $concc = calculate($con_c, $unit_c);
                    $htime = calculatet($half_b, $time_b);
                    $k_res = 0.693 / $htime;
                    $c_res = 1 / ($k_res * $conca);
                    $c_res = number_format($c_res, 5);
                    $rate_res = $k_res * $conca * $conca * $concb * $concc;
                    $rate_res = number_format($rate_res, 15);
                }else{
                    $check = false;
                }
            } else if ($module_x == '2' && $module_y == '2' && $module_z == '1') {
                // is k 1st 1st ka half time same rhy ga
                if (is_numeric($con_a) && is_numeric($con_b) || is_numeric($con_c) || is_numeric($half_a) && is_numeric($half_b) || is_numeric($half_c)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $concc = calculate($con_c, $unit_c);
                    $htime = calculatet($half_c, $time_c);
                    $k_res = 0.693 / $htime;
                    $a_res = 1 / ($k_res * $conca);
                    $a_res = number_format($a_res, 5);

                    $b_res = 1 / ($k_res * $concb);
                    $b_res = number_format($b_res, 5);
                    $rate_res = $k_res * $conca * $conca * $concb * $concb * $concc;
                    $rate_res = number_format($rate_res, 15);
                }else{
                    $check = false;
                }
            } else if ($module_x == '1' && $module_y == '2' && $module_z == '2') {
                // is k 1st 1st ka half time same rhy ga
                if (is_numeric($con_a) && is_numeric($con_b) || is_numeric($con_c) || is_numeric($half_a) && is_numeric($half_b) || is_numeric($half_c)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $concc = calculate($con_c, $unit_c);
                    $htime = calculatet($half_a, $time_a);
                    $k_res = 0.693 / $htime;
                    // die($k_res);
                    $c_res = 1 / ($k_res * $concc);
                    $c_res = number_format($c_res, 5);

                    $b_res = 1 / ($k_res * $concb);
                    $b_res = number_format($b_res, 5);
                    // echo $c_res;
                    // die;
                    $rate_res = $k_res * $concc * $concc * $concb * $concb * $conca;
                    $rate_res = number_format($rate_res, 15);
                    // die($rate_res);
                }else{
                    $check = false;
                }
            } else if ($module_x == '2' && $module_y == '2' && $module_z == '2') {
                // is k 1st 1st ka half time same rhy ga
                if (is_numeric($con_a) && is_numeric($con_b) || is_numeric($con_c) || is_numeric($half_a) && is_numeric($half_b) || is_numeric($half_c)) {
                    $conca = calculate($con_a, $unit_a);
                    $concb = calculate($con_b, $unit_b);
                    $concc = calculate($con_c, $unit_c);
                    $htime = calculatet($half_a, $time_a);
                    // $k_res = 0.693 / $htime;
                    $k_res = 1 / ($htime * $conca);
                    $k_res = round($k_res, 5);
                    // die($k_res);
                    $b_res = 1 / ($k_res * $concb);
                    $b_res = number_format($b_res, 5);

                    $c_res = 1 / ($k_res * $concc);
                    $c_res = number_format($c_res, 5);
                    // echo $c_res;
                    // die;
                    $rate_res = $k_res * $conca * $conca * $concb * $concb * $concc * $concc;
                    $rate_res = number_format($rate_res, 15);
                    // die($rate_res);
                }else{
                    $check = false;
                }
            }
        }

        if($check == true){
            $this->param['rate_res'] = $rate_res;
            $this->param['k_res'] = $k_res;
            // $this->param['heat_capacity'] = $heat_capacity;
            // $this->param['in_temp'] = $in_temp;
            // $this->param['fin_temp'] = $fin_temp;
            return $this->param;
        }else{
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
    }

    // Entropy Calculator
    public function entropy($request){
        $point_unit = trim($request->point_unit);
        $products = trim($request->products);
        $products_unit = trim($request->products_unit);
        $reactants = trim($request->reactants);
        $reactants_unit = trim($request->reactants_unit);
        $enthalpy = trim($request->enthalpy);
        $enthalpy_unit = trim($request->enthalpy_unit);
        $temperature = trim($request->temperature);
        $temperature_unit = trim($request->temperature_unit);
        $entropy = trim($request->entropy);
        $entropy_unit = trim($request->entropy_unit);
        $base_unit = trim($request->base_unit);
        $moles = trim($request->moles);
        $initial = trim($request->initial);
        $initial_unit = trim($request->initial_unit);
        $pre_one_unit = trim($request->pre_one_unit);
        $final = trim($request->final);
        $final_unit = trim($request->final_unit);
        $pre_two_unit = trim($request->pre_two_unit);

        function joules_unit($products, $products_unit){
            if ($products_unit == "j/mol*K") {
                // Already in the desired unit, no conversion needed
                return $products;
            } elseif ($products_unit == "kj/mol*K") {
                return $products * 1000;
            } elseif ($products_unit == "mj/mol*K") {
                return $products * 1000000;
            } elseif ($products_unit == "wh/mol*K") {
                return $products * 3600;
            } elseif ($products_unit == "kwh/mol*K") {
                return $products * 3.6e+6;
            } elseif ($products_unit == "ft-lb/mol*K") {
                return $products / 0.7375621493;
            } elseif ($products_unit == "cal/mol*K") {
                return $products * 4.184;
            } elseif ($products_unit == "kcal/mol*K") {
                return $products * 4184;
            } elseif ($products_unit == "ev/mol*K") {
                return $products / 6.242e+18;
            }
            return null;
        }
        function joulez_unit($products, $products_unit){
            if ($products_unit == "j") {
                // Already in the desired unit, no conversion needed
                return $products;
            } elseif ($products_unit == "kj") {
                return $products * 1000;
            } elseif ($products_unit == "mj") {
                return $products * 1000000;
            } elseif ($products_unit == "wh") {
                return $products * 3600;
            } elseif ($products_unit == "kwh") {
                return $products * 3.6e+6;
            } elseif ($products_unit == "ft-lb") {
                return $products / 0.7375621493;
            } elseif ($products_unit == "cal") {
                return $products * 4.184;
            } elseif ($products_unit == "kcal") {
                return $products * 4184;
            } elseif ($products_unit == "ev") {
                return $products / 6.242e+18;
            }
            return null;
        }
        function joulesz_unit($products, $products_unit){
            if ($products_unit == "j/K") {
                // Already in the desired unit, no conversion needed
                return $products;
            } elseif ($products_unit == "kj/K") {
                return $products * 1000;
            } elseif ($products_unit == "mj/K") {
                return $products * 1000000;
            } elseif ($products_unit == "wh/K") {
                return $products * 3600;
            } elseif ($products_unit == "kwh/K") {
                return $products * 3.6e+6;
            } elseif ($products_unit == "ft-lb/K") {
                return $products / 0.7375621493;
            } elseif ($products_unit == "cal/K") {
                return $products * 4.184;
            } elseif ($products_unit == "kcal/K") {
                return $products * 4184;
            } elseif ($products_unit == "ev/K") {
                return $products / 6.242e+18;
            }
            return null;
        }
        function temp_unit($temperature, $temperature_unit){
            if ($temperature_unit == "°C") {
                // Convert Celsius to Kelvin
                $temperature = $temperature + 273.15;
				// dd($temperature);
				// dd($temperature);
            } elseif ($temperature_unit == "°F") {
                // Convert Fahrenheit to Kelvin
                $temperature = ($temperature - 32) * (5 / 9) + 273.15;
            } elseif ($temperature_unit == "K") {
                // Temperature is already in Kelvin
                // No conversion needed
            } else {
                return null;
            }

            return $temperature;
        }
        function firstunit($initial, $initial_unit){
            if ($initial_unit == "mm³") {
                return $initial;
            } elseif ($initial_unit == "cm³") {
                return $initial * 1000;
            } elseif ($initial_unit == "dm³") {
                return $initial * 1000000;
            } elseif ($initial_unit == "m³") {
                return $initial * 1000000000;
            } elseif ($initial_unit == "in³") {
                return $initial / 0.00006102;
            } elseif ($initial_unit == "ft³") {
                return $initial * 28316846.592;
            } elseif ($initial_unit == "ml") {
                return $initial / 0.001;
            } elseif ($initial_unit == "cl") {
                return $initial * 10000;
            } elseif ($initial_unit == "l") {
                return $initial * 1000000;
            } elseif ($initial_unit == "US gal") {
                return $initial * 3785411.784;
            } elseif ($initial_unit == "UK gal") {
                return $initial * 4546090.05;
            } elseif ($initial_unit == "US fl oz") {
                return $initial / 0.000033814;
            } elseif ($initial_unit == "UK fl oz") {
                return $initial / 0.000035195;
            } else {
                return "Unit not supported";
            }
        }
        function sec_unit($initial, $pre_one_unit){
            if ($pre_one_unit == "Pa") {
                return $initial;
            } elseif ($pre_one_unit == "Bar") {
                return $initial * 100000;
            } elseif ($pre_one_unit == "psi") {
                return $initial * 6895;
            } elseif ($pre_one_unit == "at") {
                return $initial / 0.0000101972;
            } elseif ($pre_one_unit == "atm") {
                return $initial / 0.000009869;
            } elseif ($pre_one_unit == "Torr") {
                return $initial * 133.3;
            } elseif ($pre_one_unit == "hPa") {
                return $initial * 100;
            } elseif ($pre_one_unit == "kPa") {
                return $initial * 1000;
            } elseif ($pre_one_unit == "MPa") {
                return $initial * 1000000;
            } elseif ($pre_one_unit == "GPa") {
                return $initial * 1000000000;
            } elseif ($pre_one_unit == "inHg") {
                return $initial * 3386.39;
            } elseif ($pre_one_unit == "mmHg") {
                return $initial * 133.322;
            } else {
                return "Unit not supported";
            }
        }

        if ($point_unit === "entropy change for a reaction") {
            if (is_numeric($products) && is_numeric($reactants)) {
                if ($products == 0) {
                    $this->param['error'] = 'total entropy Of Products value cannot be equal to zero.';
                    return $this->param;
                }
                if ($reactants == 0) {
                    $this->param['error'] = 'total entropy Of reactants value cannot be equal to zero.';
                    return $this->param;
                }

                $products = joules_unit($products, $products_unit);
                $reactants = joules_unit($reactants, $reactants_unit);
                $entropy_reaction = $products - $reactants;

                $this->param['entropy_reaction'] = $entropy_reaction;
            } else {
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        } elseif ($point_unit === "gibbs free energy ΔG = ΔH - T*ΔS") {
            if (is_numeric($enthalpy) && is_numeric($temperature) && is_numeric($entropy)) {


                $enthalpy = joulez_unit($enthalpy, $enthalpy_unit);
                $entropy = joulesz_unit($entropy, $entropy_unit);
                $temperature = temp_unit($temperature, $temperature_unit);
                $gibbs =  $enthalpy - ($temperature * $entropy);
                $this->param['gibbs'] = $gibbs;
            } else {
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        } elseif ($point_unit === "isothermal entropy change of an ideal gas") {

            if ($base_unit === "volume") {
                if (is_numeric($moles) && is_numeric($initial) && is_numeric($final)) {
                    if ($moles == 0) {
                        $this->param['error'] = 'amount of moles value cannot be equal to zero.';
                        return $this->param;
                    }
                    if ($initial == 0) {
                        $this->param['error'] = 'initial value cannot be equal to zero.';
                        return $this->param;
                    }
                    if ($final == 0) {
                        $this->param['error'] = 'final value cannot be equal to zero.';
                        return $this->param;
                    }

                    $initial =  firstunit($initial, $initial_unit);
                    $final = firstunit($final, $final_unit);
                    $answer = $moles * 8.3145 * log($final / $initial);

                    $this->param['answer'] = $answer;
                } else {
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            } elseif ($base_unit === "pressure") {
                if (is_numeric($moles) && is_numeric($initial) && is_numeric($final)) {

                    $initial =  sec_unit($initial, $pre_one_unit);
                    $final = sec_unit($final, $pre_two_unit);

                    $answers = -$moles * 8.3145 * log($final / $initial);

                    $this->param['answers'] = $answers;
                } else {
                    $this->param['error'] = 'Please! Check Your Input.';
                    return $this->param;
                }
            } else {
                $this->param['error'] = 'Please! Check Your Input.';
                return $this->param;
            }
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
        $this->param['RESULT'] = 1;
        return $this->param;
    }

    // Solution Dilution Calculator
    public function solution($request){
        $concentration = trim($request->concentration);
        $concentration_unit = trim($request->concentration_unit);
        $volume = trim($request->volume);
        $volume_unit = trim($request->volume_unit);
        $final = trim($request->final);
        $final_unit = trim($request->final_unit);

        function unitToLiters($final, $final_unit){
            if ($final_unit == "mm³") {
                return $final / 1e+9; // Convert from mm³ to liters
            } elseif ($final_unit == "cm³") {
                return $final / 1000; // Convert from cm³ to liters
            } elseif ($final_unit == "dm³") {
                return $final; // Already in liters
            } elseif ($final_unit == "m³") {
                return $final * 1000; // Convert from m³ to liters
            } elseif ($final_unit == "in³") {
                return $final / 61023.7; // Convert from in³ to liters
            } elseif ($final_unit == "ft³") {
                return $final * 28.3168; // Convert from ft³ to liters
            } elseif ($final_unit == "yd³") {
                return $final / 764.555; // Convert from yd³ to liters
            } elseif ($final_unit == "ml") {
                return $final / 1000; // Convert from milliliters to liters
            } elseif ($final_unit == "cl") {
                return $final / 100; // Convert from centiliters to liters
            } elseif ($final_unit == "l") {
                return $final; // Already in liters
            } elseif ($final_unit == "US gal") {
                return $final * 3.78541; // Convert from US gallons to liters
            } elseif ($final_unit == "UK gal") {
                return $final * 4.54609; // Convert from UK gallons to liters
            } elseif ($final_unit == "US fl oz") {
                return $final / 33.814; // Convert from US fluid ounces to liters
            } elseif ($final_unit == "UK fl oz") {
                return $final / 35.1951; // Convert from UK fluid ounces to liters
            } elseif ($final_unit == "cups") {
                return $final * 0.284131; // Convert from cups to liters
            } elseif ($final_unit == "tbsp") {
                return $final / 67.628; // Convert from tablespoons to liters
            } elseif ($final_unit == "tsp") {
                return $final / 202.884; // Convert from teaspoons to liters
            } elseif ($final_unit == "US qt") {
                return $final * 0.946353; // Convert from US quarts to liters
            } elseif ($final_unit == "UK qt") {
                return $final * 1.13652; // Convert from UK quarts to liters
            } elseif ($final_unit == "US pt") {
                return $final / 1.05669; // Convert from US pints to liters
            } elseif ($final_unit == "UK pt") {
                return $final / 1.13652; // Convert from UK pints to liters
            } else {
                return null;
            }
        }
        function convertToMolar($concentration, $concentration_unit){
            if ($concentration_unit == "M") {
                return $concentration;
            } elseif ($concentration_unit == "mM") {
                return $concentration / 1000;
            } elseif ($concentration_unit == "μM") {
                return $concentration / 1000000;
            } elseif ($concentration_unit == "nM") {
                return $concentration / 1000000000;
            } elseif ($concentration_unit == "pM") {
                return $concentration / 1000000000000;
            } elseif ($concentration_unit == "fM") {
                return $concentration / 1000000000000000;
            } elseif ($concentration_unit == "aM") {
                return $concentration / 1e+18;
            } elseif ($concentration_unit == "zM") {
                return $concentration / 1e+21;
            } elseif ($concentration_unit == "yM") {
                return $concentration / 1e+24;
            } else {
                return null;
            }
        }

        if (is_numeric($concentration) && is_numeric($volume) && is_numeric($final)) {
            $concentration = convertToMolar($concentration, $concentration_unit);
            $volume = unitToLiters($volume, $volume_unit);
            $final = convertToMolar($final, $final_unit);
			
            if ($final === "0") {
                $this->param['error'] = 'concentration (final) cannot be zero.';
                return $this->param;
            }

            $answer = ($concentration * $volume) / $final;
        } else {
            $this->param['error'] = 'Please! Check Your Input.';
            return $this->param;
        }
        $this->param['answer'] = $answer;
        $this->param['RESULT'] = 1;

        return $this->param;
    }
}