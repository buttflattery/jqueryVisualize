How the Visualize plugin works

Accessible data visualization in HTML has always been tricky to achieve: people commonly use image elements for static charts, which provide only the most basic textual information to non-visual users; or proprietary plugins for interactive charts, which require downloads and updates by the user and don't always fully address accessibility issues.

The HTML5 canvas element provides an important breakthrough compared with those traditional methods: its native JavaScript drawing API allows us to dynamically draw bitmap images on the page, meaning we can use Canvas to generate charts and graphs based on data that's already available in the HTML.

The Visualize plugin parses key content elements in a well-structured HTML table, and leverages that native HTML5 canvas drawing ability to transform them into a chart or graph visualization. For example, table row data values serve as chart bars, lines or pie wedges; table headers become value and legend labels; and the title and caption values provide title labels within the image. Visualize also automatically checks for the highest and lowest values in the chart and uses them to calculate x-axis values for line and bar charts. Finally, the plugin includes two different CSS styles — one light and one dark — that can be used as is, or can serve as a starting point to customize chart and graph presentation to match any application style.
ARIA support now included

Though this approach to creating charts and graphs is inherently accessible — the table data remains in the page markup for screen readers and browsers that don't support JavaScript — we realized that the canvas element needed ARIA attributes to better identify it as a visualization. In the latest update to Visualize, we edited the plugin to automatically assign two ARIA attributes to the chart container to more clearly identify its purpose to screen readers:

    role="image" – tells screen readers that the chart is purely visual, and can therefore be skipped
    aria-label="Chart representing data from: [table caption value]" – specifically identifies the chart's content as belonging to the associated table

Visualize in action: a quick demo

In the example below, we have an HTML table populated with sample data of a number of employees and their sales by store department. We've generated 4 charts from this table, which are shown below.

Demo page of Visualize plugin with 4 charts

NOTE on the "View low bandwidth" link: This demo runs on our EnhanceJS framework, which applies progressive enhancement based on browser capabilities, and adds a "View low-bandwidth version" link to allow users to toggle from a basic to enhanced view, dropping a cookie on change to record the user's preference. If you click the link to view the low-bandwidth version of the demo, just remember that you'll need to click it again to view the enhanced version of this site on future views. (You can read more about EnhanceJS at the following article: Introducing EnhanceJS: A smarter, safer way to apply progressive enhancement.)

Alternate style: We also created a "vanilla" style for the charts: Visualize "Vanilla" style variation
How to use Visualize

First, you'll need to create the table markup:

<table>
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
        ...repetitive rows removed for brevity.
    </tbody>
</table>

Note that we've used a caption element to summarize the table data. This will be used by the Visualize plugin to create a title on your graph. We've also defined our table headings using th elements, letting the script know which cells it should use as the titles for a data set.

Now that we have our HTML table, we can generate a chart. Just attach jQuery and our Visualize plugin's JavaScript and CSS files to your page, and call the visualize() method on the table, like this:

$('table').visualize();

That's it! By default, the Visualize plugin will generate the first bar chart shown above and append it to your page directly after the table.
Finding a generated chart on the page

Once you call the visualize() method on a table, the new chart element will be returned to the method, allowing you to continue your jQuery chain acting upon the chart instead of the table. Charts generated by this plugin are contained within a div element with a class of "visualize" as well as a class of the chart type, such as "visualize-pie". These classes make it easy to find your chart after it's generated, for additional presentation and behavioral modifications. Another nice way to do this is to store your generated chart in a variable, like this: var myChart = $('table').visualize();. Then you can simply reference myChart later on in your script to make any modifications to it, or to remove it from the page.
Updating a chart

Every chart generated by the Visualize plugin has a custom event that can be used to refresh itself using its original settings, including which table it should pull data from. This is handy for dynamic pages with charts that can update frequently. In fact, we made use of this event when creating the editable table example above. To refresh an existing chart, simple trigger the visualizeRefresh event on the generated chart element, like this:

$('.visualize').trigger('visualizeRefresh');

Appending the chart to other areas of the page

Since calling the visualize() method returns the new chart element, it's easy to immediately append the chart to another area of the page using jQuery's appendTo method. However, once you move the chart to another area in the DOM, you must trigger the visualizeRefresh method on it in order for it to display properly in Internet Explorer 6 and 7. The following code demonstrates appending the chart to the end of the page, and then triggering the visualizeRefresh method on it:

$('table')
   .visualize()
   .appendTo('body')
   .trigger('visualizeRefresh');

Styling the charts with CSS

Three CSS files accompany the Visualize plugin that set the overall layout, background and text colors for the key, title, grid lines, and axis labels:

    visualize.css – sets structural properties like display and positioning that control layout and placement. This stylesheet is required for the charts to appear as they do in the demo.
    visualize-dark.css – contains style properties for the dark look-and-feel, as shown in the demo above
    visualize-light.css – can be used in place of visualize-dark.css for a lighter appearance. (See a demo.)

Configuring Visualize to create customized charts

The following options are available for configuring the type of chart and its visual characteristics:

    type: string. Accepts 'bar', 'area', 'pie', 'line'. Default: 'bar'.
    width: number. Width of chart. Defaults to table width
    height: number. Height of chart. Defaults to table height
    appendTitle: boolean. Add title to chart. Default: true.
    title: string. Title for chart. Defaults to text of table's Caption element.
    appendKey: boolean. Add the color key to the chart. Default: true.
    colors: array. Array items are hex values, used in order of appearance. Default: ['#be1e2d','#666699','#92d5ea','#ee8310','#8d10ee','#5a3b16','#26a4ed','#f45a90','#e9e744']
    textColors: array. Array items are hex values. Each item corresponds with colors array. null/undefined items will fall back to CSS text color. Default: [].
    parseDirection: string. Direction to parse the table data. Accepts 'x' and 'y'. Default: 'x'.
    pieMargin: number. Space around outer circle of Pie chart. Default: 20.
    pieLabelPos: string. Position of text labels in Pie chart. Accepts 'inside' and 'outside'. Default: 'inside'.
    lineWeight: number. Stroke weight for lines in line and area charts. Default: 4.
    barGroupMargin: number. Space around each group of bars in a bar chart. Default: 10.
    barMargin: number. Creates space around bars in bar chart (added to both sides of each bar). Default: 1

To use the options, simply pass them as an argument to the visualize() method using object literal notation, just like most other jQuery plugins you're used to (for example: visualize({ optionA: valueA, optionB: valueB});).
Browser support

We've tested this plugin in the following browsers: IE6, IE7, IE8, Firefox 2, Firefox 3.5, Safari 3 and 4, Opera 9.
For Internet Explorer support

This plugin uses the HTML5 canvas element, which is not supported in Internet Explorer at this time. Fortunately, Google maintains a library that translates canvas scripting into VML, called excanvas.js, which we used to extend Visualize support to IE browsers. We've included a slightly modified version of excanvas.js with the Visualize plugin's code zip that's also compatible with EnhanceJS, our capabilities testing library.
Download (and help us improve) the code

The Visualize plugin code is open source and available in a git repository, jQuery-Visualize. If you think you can help on a particular issue, please submit a pull request and we'll review it as soon as possible.

If you've already purchased Designing with Progressive Enhancement, you can download all twelve widgets at the code examples download page.
