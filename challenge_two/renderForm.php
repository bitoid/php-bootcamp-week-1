<form class="form-get" method="post" action="/challenge_two/challenge-two.php">
  <h1>Input your git Username to see magic!</h1>
  <input type="text" id="username" name="username" class="input input-text">
  <p class="checklist-title">What do you want to see?</p>
    <div class="checkbox">
      <input type="checkbox" name="repos" id="repos" value="yes">
      <label for="repos">Repositories</label>
    </div>
    <div class="checkbox">
      <input type="checkbox" name="followers" id="followers" value="yes">
      <label for="followers">Followers</label>
    </div>
  <button type="submit" name="submit" class="label-button-two">Submit</button>
</form>
