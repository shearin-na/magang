use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHistoryToPatients extends Migration
{
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->date('tanggal_input')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('tanggal_input');
            $table->dropColumn('is_active');
        });
    }
} 