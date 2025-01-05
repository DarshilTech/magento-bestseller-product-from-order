<?php

namespace DarshilTech\Bestsellers\Model;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\File\Csv;
use Magento\Framework\App\Filesystem\DirectoryList;

class BestSellerExport
{
    protected $resourceConnection;
    protected $csvProcessor;
    protected $directoryList;

    public function __construct(
        ResourceConnection $resourceConnection,
        Csv $csvProcessor,
        DirectoryList $directoryList
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->csvProcessor = $csvProcessor;
        $this->directoryList = $directoryList;
    }

    /**
     * Export best-seller products to a CSV file.
     *
     * @param string $startDate Start date (YYYY-MM-DD format).
     * @param string $endDate End date (YYYY-MM-DD format).
     * @param string $fileName Name of the output CSV file.
     * @return string Path to the generated CSV file.
     */
    public function exportBestSellers($startDate, $endDate, $fileName = 'bestsellers.csv')
    {
        try {
            $connection = $this->resourceConnection->getConnection();

            // Query to fetch best-sellers within the specified date range
            $sql = "
            SELECT 
                soi.sku, 
                MIN(soi.name) AS name, 
                SUM(soi.qty_ordered) AS total_qty, 
                SUM(soi.row_total) AS total_sales
            FROM 
                sales_order_item AS soi
            INNER JOIN 
                sales_order AS sos 
                ON soi.order_id = sos.entity_id
            WHERE 
                sos.created_at BETWEEN :start_date AND :end_date
                AND sos.status = 'complete'
            GROUP BY 
                soi.sku
            ORDER BY 
                total_qty DESC
        ";
            $bind = [
                'start_date' => $startDate . ' 00:00:00',
                'end_date' => $endDate . ' 23:59:59'
            ];

            $results = $connection->fetchAll($sql, $bind);

            // CSV file path
            $filePath = $this->directoryList->getPath(DirectoryList::VAR_DIR) . '/' . $fileName;

            // Prepare header and data for CSV
            $data = [['SKU', 'Product Name', 'Total Quantity Sold']];
            foreach ($results as $row) {
                $data[] = [$row['sku'], $row['name'], $row['total_qty']];
            }

            // Generate CSV file
            $this->csvProcessor->saveData($filePath, $data);

            return $filePath; // Return the path to the generated CSV file
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
