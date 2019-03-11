<?php /** @noinspection ALL */

namespace App\Providers;


use App\Models\v2\Kodp;
use App\Models\v2\ApproveCode;
use App\Models\v2\Company;
use App\Models\v2\Constant;
use App\Models\v2\Error;
use App\Models\v2\Log;
use App\Models\v2\Nskz;
use App\Models\v2\Order;
use App\Models\v2\Position;
use App\Models\v2\PositionWithActiveTransaction;
use App\Models\v2\Soato;
use App\Models\v2\Structure;
use App\Models\v2\Transaction;
use App\Models\v2\User;
use App\Policies\ApproveCodePolicy;
use App\Policies\CompanyPolicy;
use App\Policies\ConstantPolicy;
use App\Policies\ErrorPolicy;
use App\Policies\KodpPolicy;
use App\Policies\LogPolicy;
use App\Policies\NskzPolicy;
use App\Policies\OrderPolicy;
use App\Policies\PositionPolicy;
use App\Policies\SoatoPolicy;
use App\Policies\StructurePolicy;
use App\Policies\TransactionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;



/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Policy
         */
        Gate::policy(ActiveContract::class, ActiveContractPolicy::class);
        Gate::policy(ApproveCode::class, ApproveCodePolicy::class);
        Gate::policy(ArchiveContract::class, ArchiveContractPolicy::class);
        Gate::policy(Company::class, CompanyPolicy::class);
        Gate::policy(Constant::class, ConstantPolicy::class);
        Gate::policy(Error::class, ErrorPolicy::class);
        Gate::policy(Kodp::class, KodpPolicy::class);
        Gate::policy(Log::class, LogPolicy::class);
        Gate::policy(Nskz::class, NskzPolicy::class);
        Gate::policy(Position::class, PositionPolicy::class);
        Gate::policy(PositionWithActiveTransaction::class, PositionWithActiveTransactionPolicy::class);
        Gate::policy(Soato::class, SoatoPolicy::class);
        Gate::policy(Structure::class, StructurePolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Transaction::class, TransactionPolicy::class);

        /**
         * Validators
         */

        Validator::extend('kodp', 'App\Validators\KodpValidator@validateKodp');
        Validator::replacer('kodp', 'App\Validators\KodpValidator@message');

        Validator::extend('company', 'App\Validators\CompanyValidator@validateCompany');
        Validator::replacer('company', 'App\Validators\CompanyValidator@message');

        Validator::extend('position', 'App\Validators\PositionValidator@validatePosition');
        Validator::replacer('position', 'App\Validators\PositionValidator@message');

        Validator::extend('rate', 'App\Validators\ConstantValidator@validateRate');
        Validator::replacer('rate', 'App\Validators\ConstantValidator@message');

        Validator::extend('terms_of_payment', 'App\Validators\ConstantValidator@validateTermsOfPayment');
        Validator::replacer('terms_of_payment', 'App\Validators\ConstantValidator@message');

        Validator::extend('employment_type', 'App\Validators\ConstantValidator@validateEmploymentType');
        Validator::replacer('employment_type', 'App\Validators\ConstantValidator@message');

        Validator::extend('workbook_reason', 'App\Validators\ConstantValidator@validateWorkbookReason');
        Validator::replacer('workbook_reason', 'App\Validators\ConstantValidator@message');

        Validator::extend('transaction_exist_and_not_approved', 'App\Validators\TransactionValidator@validateTransactionExistAndNotApproved');
        Validator::replacer('transaction_exist_and_not_approved', 'App\Validators\TransactionValidator@message');

        Validator::extend('person', 'App\Validators\PersonValidator@validatePerson');
        Validator::replacer('person', 'App\Validators\PersonValidator@message');

        Validator::extend('position_with_active_transaction', 'App\Validators\PositionWithActiveTransactionValidator@validatePositionWithActiveTransaction');
        Validator::replacer('position_with_active_transaction', 'App\Validators\PositionWithActiveTransactionValidator@message');

        Validator::extend('structure', 'App\Validators\StructureValidator@validateStructure');
        Validator::replacer('structure', 'App\Validators\StructureValidator@message');

        Validator::extend('user', 'App\Validators\UserValidator@validateUser');
        Validator::replacer('user', 'App\Validators\UserValidator@message');




        Gate::before(function ($user) {
            if ($user->type === 5) {
                return true;
            }
        });

        Gate::define('co', function ($user) {

            return $user->type === 2;

        });

        Gate::define('citizen', function ($user) {

            return $user->type === 1;

        });

        //TODO пересмотреть
        Gate::define('workbook', function ($user) {

            return $user->type > 2;

        });


    }
}
