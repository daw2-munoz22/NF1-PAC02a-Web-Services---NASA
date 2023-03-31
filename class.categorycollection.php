<?php
require("abstract.databoundobject.php");      
class categorycollection extends DataBoundObject {       
        public $categoryid;                 
        public $title;
        public $description;
        public $link;
        public $id;
        public $categorytitle;
        public $categorylink;
        public $categorydescription;
        public $layers;

        protected function DefineTableName() {
                return("categorycollection");
        }

        protected function DefineRelationMap() {
                return(array(                        
                        "categoryid" => "categoryid",
                        "title" => "title",
                        "description" => "description",
                        "link" => "link",
                        "id" => "id",
                        "categorytitle" => "categorytitle",
                        "categorylink" => "categorylink",
                        "categorydescription" => "categorydescription",
                        "layers" => "layers")
                );
        }
        public function setcategoryid($categoryid) {
                $this->categoryid = $categoryid;
                $this->arModifiedRelations["categoryid"] = $this->categoryid;
        }
        public function settitle($title) {
                $this->title = $title;
                $this->arModifiedRelations["title"] = $this->title;
        }

        public function setdescription($description) {
                $this->description = $description;
                $this->arModifiedRelations["description"] = $this->description;
        }
          
        public function setlink($link) {
                $this->link = $link;
                $this->arModifiedRelations["link"] = $this->link;
        }
        public function setid($id) {
                $this->id = $id;
                $this->arModifiedRelations["id"] = $this->id;
        }

        public function setcategorytitle($categorytitle) {
                $this->categorytitle = $categorytitle;
                $this->arModifiedRelations["categorytitle"] = $this->categorytitle;
        }

        public function setcategorydescription($categorydescription) {
                $this->categorydescription = $categorydescription;
                $this->arModifiedRelations["categorydescription"] = $this->categorydescription;
        }
        public function setcategorylink($categorylink) {
                $this->categorylink = $categorylink;
                $this->arModifiedRelations["categorylink"] = $this->categorylink;
        }
        public function setlayers($layers) {
                $this->layers = $layers;
                $this->arModifiedRelations["layers"] = $this->layers;
        }
        
        public function getcategoryid() {
                return $this->categoryid;
        }    
        public function gettitle() {
                return $this->title;
        }       
        public function getdescription() {
                return $this->description;
        }       
        public function getlink() {
                return $this->link;
        }       
        public function getid() {
                return $this->id;
        }       
        public function getcategorytitle() {
                return $this->categorytitle;
        }    
        public function getcategorylink() {
                return $this->categorylink;
        }        
        public function getcategorydescription() {
                return $this->categorydescription;
        }       
        public function getlayers() {
                return $this->layers;
        }          
}
?>