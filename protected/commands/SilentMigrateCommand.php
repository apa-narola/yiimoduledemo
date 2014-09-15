<?php


Yii::import('system.cli.commands.MigrateCommand');

class SilentMigrateCommand extends MigrateCommand
{

    public function actionUp($args) {
        if (($migrations = $this->getNewMigrations()) === array()) {
            echo "No new migration found. Your system is up-to-date.\n";
            return 0;
        }

        $total = count($migrations);
        $step = isset($args[0]) ? (int) $args[0] : 0;
        if ($step > 0)
            $migrations = array_slice($migrations, 0, $step);

        $n = count($migrations);
        foreach ($migrations as $migration) {
            if ($this->migrateUp($migration) === false) {
                echo "\nMigration failed. All later migrations are canceled.\n";
                return 2;
            }
        }
        echo "\nMigrated up successfully.\n";
    }

}
