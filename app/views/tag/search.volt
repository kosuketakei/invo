{{ content() }}

<ul class="pager">
    <li class="previous">
        {{ link_to("tag", "&larr; Go Back") }}
    </li>
    <li class="next">
        {{ link_to("tag/new", "Create Test Data", "class": "btn btn-primary") }}
    </li>
</ul>

{% for dataTag in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ dataTag.id }}</td>
            <td>{{ dataTag.name }}</td>
            <td width="7%">{{ link_to("tag/edit/" ~ dataTag.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("tag/delete/" ~ dataTag.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="4" align="right">
                <div class="btn-group">
                    {{ link_to("tag/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("tag/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("tag/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("tag/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
    {% endif %}
{% else %}
    No data recorded
{% endfor %}
