<div class="main">
    <h1 class="text-center">Hackaton</h1>
    <form action="#">
        <div class="row">
            <div class="col">
                <input type="text" placeholder="Username">
            </div>
            <div class="col">
                <input type="text" placeholder="password">
            </div>
        </div>
        <button type="submit">Submit</button>
    </form>
    <p>New to the hackathon? <a href="<?=(new App\Services\Route)->link('register')?>">link</a></p>
</div>