#YII JqueryVisualize
##Introduction 

The plugin is created originaly by the filament group 
http://www.filamentgroup.com/lab/update-to-jquery-visualize-accessible-charts-with-html5-from-designing-with.html

Demo Page: http://www.filamentgroup.com/examples/jqueryui-visualize/vanilla.html

##Integration in Yii Framework 
    This extension is tested with Yii 1.1.15 will work for lower version too 

##Installation 
unzip the jqueryVisualize.zip to you extensions directory

```php
application/extension/jqueryVisualize
```
Direct import into page 
```php
Yii::import('ext.jqueryVisualize.jqueryVisualize');
```
OR Add to autoloading in application/config/main.php
```php
'import' => array(
'ext.jqueryVisualize.jqueryVisualize',
```

#How the Visualize plugin works

###Example 1 : BAR CHARTS
create a table inside your view 
```
<table id="employe-data">
        <caption>2009 Employee Sales by Department</caption>
        <thead>
        <tr>
            <td></td>
            <th scope="col">food</th>
            <th scope="col">auto</th>
            <th scope="col">household</th>
            <th scope="col">furniture</th>
            <th scope="col">kitchen</th>
            <th scope="col">bath</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Mary</th>
            <td>190</td>
            <td>160</td>
            <td>40</td>
            <td>120</td>
            <td>30</td>
            <td>70</td>
        </tr>
        <tr>
            <th scope="row">Tom</th>
            <td>3</td>
            <td>40</td>
            <td>30</td>
            <td>45</td>
            <td>35</td>
            <td>49</td>
        </tr>
        <tr>
            <th scope="row">Brad</th>
            <td>10</td>
            <td>180</td>
            <td>10</td>
            <td>85</td>
            <td>25</td>
            <td>79</td>
        </tr>
        <tr>
            <th scope="row">Kate</th>
            <td>40</td>
            <td>80</td>
            <td>90</td>
            <td>25</td>
            <td>15</td>
            <td>119</td>
        </tr>
        </tbody>
    </table>
```
Provide an id to the table and then use it as a selector you can use the classname or even element name for selector but it is preferred to use an id.

###calling the widget
There are various options for he plugin which can be configured please see https://github.com/filamentgroup/jQuery-Visualize for more detail 
you can pass all available options in the plugin to the extension see bellow
```
<?php
    $this->widget('ext.jqueryVisualize.jqueryVisualize',
        array(
            'type'=>'bar',
            'width'=>500,
            'selector'=>'#employe-data',
        )
    );
?>
```
you can even hide the source table after populating the graph, and provide custom title for the charts if you want see the below example, if you are listing the standard listing quota for any site user.

###Example 2: using AREA STYLE & Hiding Source table 
```
<table id="stadardquota" ><!--Table Contents Start here-->
    <thead>
    <tr>
        <td>-</td>
        <th style="text-align:center;" scope="col">Quota</th>
        <th style="text-align:center;" scope="col">Available</th>
        <th style="text-align:center;" scope="col">Used</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th style="text-align:center;" scope="col">Consumption</th>
        <td data-title="Quota" style="text-align:center;">20</td>
        <td data-title="Available" style="text-align:center;">5</td>
        <td data-title="Used" style="text-align:center;">15</td>
    </tr>
    </tbody>
</table><!--Table Contents End here-->
```
###calling the widget
```
<?php
$this->widget('ext.jqueryVisualize.jqueryVisualize',
    array(
        'type'=>'area',
        'width'=>500,
        'title'=>'Custom Title separate than table heading',
        'selector'=>'#stadardquota',
        'hideContainer'=>TRUE //default is FALSE
    )
);
?>
```
