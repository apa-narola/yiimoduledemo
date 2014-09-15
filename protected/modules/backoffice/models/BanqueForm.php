<?php

class BanqueForm extends Banque
{
    public function rules()
    {
        return array(
            array('id, societe_id, beneficiaire, code_iban, code_bic, status', 'safe')
        );
    }
}
