
<h1>Hello, {{username}}</h1>
<h3>This page shows your information used for INVO</h3>

{% for user in users %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{user.id}}</td>
            <td>{{user.name}}</td>
            <td>{{user.username}}</td>
            <td>{{user.password}}</td>
            <td>{{user.email}}</td>
        </tr>
    </tbody>
    <p width="7%">{{ link_to("info/editName/" ~ user.id, '<i class="glyphicon glyphicon-edit"></i> Edit your name', "class": "btn btn-default") }}</p>
    <p width="7%">{{ link_to("info/editPassword/" ~ user.id, '<i class="glyphicon glyphicon-edit"></i> Edit your password', "class": "btn btn-default") }}</p>
    <p width="7%">{{ link_to("info/delete/" ~ user.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</p>
</table>
{% endfor %}