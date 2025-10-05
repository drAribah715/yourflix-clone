<?php
include_once 'config/database.php';
include_once 'classes/Movie.php';

$database = new Database();
$db = $database->getConnection();
$movie = new Movie($db);

$stmt = $movie->getTrending();
$trending_movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Welcome to YourFlix</h1>
            <p>Discover thousands of movies and TV shows. Stream your favorites anytime, anywhere.</p>
            <button class="cta-button">Start Watching</button>
        </div>
    </section>

    <!-- Trending Section -->
    <section class="content-section" id="movies">
        <h2 class="section-title">Trending Now</h2>
        <div class="movies-grid" id="trending-grid">
            <?php foreach($trending_movies as $movie_item): ?>
                <div class="movie-card">
                    <img src="<?php echo htmlspecialchars($movie_item['poster_url']); ?>" 
                         alt="<?php echo htmlspecialchars($movie_item['title']); ?>" 
                         class="movie-poster"
                         onerror="this.src='https://via.placeholder.com/200x300/333/fff?text=No+Image'">
                    <div class="movie-info">
                        <h3 class="movie-title"><?php echo htmlspecialchars($movie_item['title']); ?></h3>
                        <div class="movie-meta">
                            <span><?php echo $movie_item['year']; ?> • <?php echo $movie_item['duration']; ?></span>
                            <span class="movie-rating"><?php echo $movie_item['rating']; ?></span>
                        </div>
                        <p class="movie-description"><?php echo htmlspecialchars($movie_item['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="content-section" id="genres">
        <h2 class="section-title">Browse by Genre</h2>
        <div class="categories">
            <button class="category-btn active" data-category="all">All</button>
            <button class="category-btn" data-category="Action">Action</button>
            <button class="category-btn" data-category="Comedy">Comedy</button>
            <button class="category-btn" data-category="Drama">Drama</button>
            <button class="category-btn" data-category="Horror">Horror</button>
            <button class="category-btn" data-category="Sci-Fi">Sci-Fi</button>
            <button class="category-btn" data-category="Crime">Crime</button>
        </div>
        <div class="movies-grid" id="filtered-movies">
            <!-- Movies will be loaded here via JavaScript -->
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
