<?
namespace Foolery;

class DataSource
{
  private const HOST = 'localhost';
  private const USERNAME = 'glazpmck_ics370';
  private const PASSWORD = 'BZgGYMd4BSqTiNb';
  private const DATABASENAME = 'glazpmck_ics370';

  private $conn;

  function __construct()
  {
    $this->conn = $this->getConnection();
  }

  public function getConnection()
  {
    $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

    if (\mysqli_connect_errno()){
      trigger_error("Problem with connecting to database.");
    }

    $conn->set_charset("utf8");
    return $conn;
  }

  //Get DB Select Query Results
  public function select($query, $paramType, $paramArray)
  {
    $stmt = $this->conn->prepare($query);

    if (!empty($paramType) && !empty($paramArray)) {
      $this->bindQueryParams($stmt, $paramType, $paramArray);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
      while ($row = $result->fetch_assoc()){
        $resultset[] = $row;
      }
    }

    if (!empty($resultset)) {
      return $resultset;
    }
  }

  //Run Insert query
  public function insert($query, $paramType, $paramArray)
  {
    print $query;
    $stmt = $this->conn->prepare($query);
    $this->bindQueryParams($stmt, $paramType, $paramArray);
    $stmt->execute();
    $insertId = $stmt->insert_id;
    return $insertId;
  }

  //execute query
  public function execute($query, $paramType="", $paramArray=[])
  {
      $stmt = $this->conn->prepare($query);
      
      if(!empty($paramType) && !empty($paramArray)) {
          $this->bindQueryParams($stmt, $paramType, $paramArray);
      }
      $stmt->execute();
  }

  //Parameter binding
  public function bindQueryParams($stmt, $paramType, $paramArray=[])
  {
      $paramValueReference[] = & $paramType;
      for ($i = 0; $i < count($paramArray); $i ++) {
          $paramValueReference[] = & $paramArray[$i];
      }
      call_user_func_array([$stmt, 'bind_param'], $paramValueReference);
  }

  //get DB results
  public function numRows($query, $paramType="", $paramArray=[])
  {
    $stmt = $this->conn->prepare($query);
        
    if(!empty($paramType) && !empty($paramArray)) {
        $this->bindQueryParams($stmt, $paramType, $paramArray);
    }
        
    $stmt->execute();
    $stmt->store_result();
    $recordCount = $stmt->num_rows;
    return $recordCount;
  }
}