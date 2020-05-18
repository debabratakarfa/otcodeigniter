<div class="container">
    <h2 class="mt-5 mb-5">List of Users</h2>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Register at</th>
        </tr>
        </thead>
        <tbody>
            {profiles}
            <tr>
                <td>{first_name}</td>
                <td>{last_name}</td>
                <td>{email_address}</td>
                <td>{created_at}</td>
            </tr>
            {/profiles}
        </tbody>
    </table>
</div>
