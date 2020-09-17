
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
        </tr>>
    </tbody>
</table>
{% endfor %}