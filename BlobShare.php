<?php

class BlobShare {
      const BASE_URL = 'http://blobshare.rocks/';
      function add($blob_name,$data) {
            return json_decode($this->custom_http($this->blob_url($blob_name),'POST',json_encode($data),true));
      }      

      function update($blob_name,$data) {
            return json_decode($this->custom_http($this->blob_url($blob_name),'PATCH',json_encode($data),true));
      }

      function get($blob_name) {
            return json_decode($this->custom_http($this->blob_url($blob_name),'GET'));            
      }

      function delete($blob_name) {
            return json_decode($this->custom_http($this->blob_url($blob_name),'DELETE'));
      }

      private function custom_http($url,$method,$fields='',$mimetype='') {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HEADER, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST,$method);
            if($fields) curl_setopt($curl, CURLOPT_POSTFIELDS,$fields);
            if($mimetype) curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($fields)));
            $resp=curl_exec($curl);
            curl_close($curl);
            return $resp;
      }

      private function blob_url($blob_name) {
          $url = self::BASE_URL . urlencode($blob_name);
          return $url;
      }
};

$bs = new BlobShare();

echo var_dump($bs->get('pete'));

$json = array('Somekey'=>'Somevalue');
echo var_dump($bs->add('Petey',$json));
sleep(2);
echo var_dump($bs->get('Petey'));

$json = array('Somekey'=>'SomeOtherValue', 'NewKey'=>'NewValue');
echo var_dump($bs->update('Petey',$json));
sleep(2);
echo var_dump($bs->get('Petey'));

echo var_dump($bs->delete('Petey'));
sleep(2);
echo var_dump($bs->get('Petey'));

?>