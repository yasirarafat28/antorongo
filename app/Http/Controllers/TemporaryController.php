<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Fdr;
use App\FdrTransaction;
use App\Loan;
use App\LoanTransaction;
use App\Saving;
use App\User;

class TemporaryController extends Controller
{
    //

    public function loan_transaction_to_transaction_table(){

        $l_transactions = LoanTransaction::get();
        foreach($l_transactions??array() as $l_transaction){

        }
    }

    public function DecryptTest()
    {
        //$val = decrypt(Auth::user()->getOriginal('password'),true);
        return Crypt::decryptString(Auth::user()->password);
        return $val;
    }


    public function UniqueIdTransparent(){

    	$fdr = Fdr::all();
    	foreach ($fdr as $key => $item) {
    		$temp = $item->txn_id;
    		$item->old_txn= $temp;
    		$item->txn_id= uniqid();
    		$item->save();
    	}
    	$loan = Loan::all();
    	foreach ($loan as $key => $item) {
    		$temp = $item->unique_id;
    		$item->old_txn= $temp;
    		$item->unique_id= uniqid();
    		$item->save();
    	}
    	$saving = Saving::all();
    	foreach ($saving as $key => $item) {
    		$temp = $item->txn_id;
    		$item->old_txn= $temp;
    		$item->txn_id= uniqid();
    		$item->save();
    	}

    }

    public function MemberFilter()
    {
    	$count = 0;
    	$users = User::all();
    	foreach ($users as $key => $user) {
    		$abc =  User::where('unique_id',$user->unique_id)->get();
    		if (sizeof($abc)<2) {
    			continue;
    		}
    		$duplicate_user = User::where('unique_id',$user->unique_id)->where('id','!=',$user->id)->get();

    		foreach ($duplicate_user as $sub_key => $sub_user) {

    			$loans = Loan::where('user_id',$sub_user->id)->get();
    			foreach ($loans as $key => $loan) {
    				$loan->user_id = $user->id;
    				$loan->save();
    			}
    			$savings = Saving::where('user_id',$sub_user->id)->get();
    			foreach ($savings as $key => $saving) {
    				$saving->user_id = $user->id;
    				$saving->save();
    			}
    			$fdrs = Fdr::where('user_id',$sub_user->id)->get();
    			foreach ($fdrs as $key => $fdr) {
    				$fdr->user_id = $user->id;
    				$fdr->save();
    			}

    			/*Loan::where('user_id',$sub_user->id)->update(['user_id'=>$user->id]);
    			Saving::where('user_id',$sub_user->id)->update(['user_id'=>$user->id]);
    			Fdr::where('user_id',$sub_user->id)->update(['user_id'=>$user->id]);*/

    			User::destroy($sub_user->id);

    			$count++;
    		}
    	}

    	return $count;
    }

    public function fdr_transaction_sync(){
        $records = Fdr::get();
        foreach($records as  $fdr){
            $prev_deposit = FdrTransaction::where('fdr_id',$fdr->id)->where('type','deposit')->sum('amount');
            $fdr->amount = $prev_deposit;
            $fdr->status = 'pending';
            $fdr->save();

        }
        return 'success';

    }

    public function permission_asncronas(){
        $admin   = \Spatie\Permission\Models\Role::findByName('super_admin');

        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'balance-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'balance-transfer-from']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'member-find']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'member-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'member-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'member-show']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'member-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'member-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-application']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }

        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-find']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-approve']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-decline']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-close']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-print']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-show']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        // $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-collection-report']);
        // if ($permission){
        //     $admin->givePermissionTo($permission->name);
        // }

        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-collection-report-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }

        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-withdraw-report-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-packages-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-packages-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-packages-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving-short-packages-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        // $permission = \Spatie\Permission\Models\Permission::create(['name' => 'saving/daily-application']);
        // if ($permission){
        //     $admin->givePermissionTo($permission->name);
        // }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-application']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-find']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-approve']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-decline']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-close']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-profit-report-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-print']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'fdr-withdraw-report-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-application']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-find']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-show']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-approve']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-reject']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-close']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-print']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'loan-depository']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-head-income-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-head-income-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-head-income-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-head-income-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'income-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }

        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'income-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }

        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'income-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'income-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        // $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-head-expense-list']);
        // if ($permission){
        //     $admin->givePermissionTo($permission->name);
        // }
        // $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-head-expense-edit']);
        // if ($permission){
        //     $admin->givePermissionTo($permission->name);
        // }
        // $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-head-expense-show']);
        // if ($permission){
        //     $admin->givePermissionTo($permission->name);
        // }
        // $permission = \Spatie\Permission\Models\Permission::create(['name' => 'transaction-head-expense-delete']);
        // if ($permission){
        //     $admin->givePermissionTo($permission->name);
        // }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'expense-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }

        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'expense-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'expense-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'expense-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'meeting-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'meeting-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'meeting-show']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'meeting-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'meeting-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'documents-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'documents-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'documents-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'documents-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'user-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'user-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'user-show']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'user-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'user-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }

        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'roles-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'roles-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'roles-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'roles-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-setup-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-setup-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-setup-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-setup-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-setup-show']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-payment-list']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-payment-create']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-payment-edit']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-payment-delete']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'hr-salary-payment-show']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }


        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'statement-customize']);
        if ($permission){
            $admin->givePermissionTo($permission->name);
        }

        return 'success';

    }


    public function sync_user_project(){

        User::where('unique_id','like','%FD%')
        ->update('project','fdr_member');


        User::where('unique_id','like','%FM%')
        ->update('project','founding_member');
    }
}
