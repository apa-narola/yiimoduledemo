<?php

class GridSummaryText extends CWidget
{

    public $dataProvider;

    public function run()
    {
        if(($count=$this->dataProvider->getItemCount())<=0)
            return;
        
        $pagination = $this->dataProvider->getPagination();
        $total = $this->dataProvider->getTotalItemCount();
        $start = $pagination->currentPage * $pagination->pageSize + 1;
        $end = $start + $count - 1;
        if ($end > $total) {
            $end = $total;
            $start = $end - $count + 1;
        }
        $summaryText = Yii::t('zii', 'Displaying {start}-{end} of 1 result.|Displaying {start}-{end} of {count} results.', $total);

        echo strtr($summaryText, array(
            '{start}' => $start,
            '{end}' => $end,
            '{count}' => $total,
            '{page}' => $pagination->currentPage + 1,
            '{pages}' => $pagination->pageCount,
        ));
    }

}
