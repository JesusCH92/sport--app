<!-- View/team-creator/index.php -->
<h1>Team Creator!</h1>
<p>Welcome to the team creator page.</p>

<div class="container border__container padding__container">
    <form action="/team-creator" method="POST">
        <div>
            <label for="name">Team Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="city">City:</label>
            <select id="city" name="city" required>
                <option value="Barcelona">Barcelona</option>
                <option value="Madrid">Madrid</option>
            </select>
        </div>

        <div>
            <button type="submit">Create Team</button>
        </div>
    </form>
</div>