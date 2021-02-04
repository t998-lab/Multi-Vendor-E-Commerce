    <section id="footer-bar">
        <div class="row">
            <div class="span2">
                <h4>Navigation</h4>
                <ul class="nav">
                    <li><a href="./index.php">Homepage</a></li>
                    <li><a href="#contact_info">Contact Us</a></li>
                    <li><a href="./cart.php">Your Cart</a></li>
                   
                </ul>
            </div>
			<div class="span8">
                <h4>Category</h4>
                <ul class="nav">
					<?php
							
							$category=mysqli_query($conn,"SELECT * FROM category");
							while($fetch_category=mysqli_fetch_assoc($category))
							{$catID=strtr(base64_encode($fetch_category['Cat_ID']), '+/=', '-_,');
								echo "<li><a href='products.php?i=".$catID."'>{$fetch_category['Cat_Name']}</a></li>";
							}
							?>
                 </ul>
            </div>
        </div>
    </section>

    <section id="copyright"><span>Copyright 2013 bootstrappage template All right reserved.Edited By Tima Aljayyousi</span></section><script src="themes/js/common.js" type="text/javascript">
</script><script src="themes/js/jquery.flexslider-min.js" type="text/javascript">
</script><script type="text/javascript">
                    $(function() {
                                $(document).ready(function() {
                                        $('.flexslider').flexslider({
                                                animation: "fade",
                                                slideshowSpeed: 4000,
                                                animationSpeed: 600,
                                                controlNav: false,
                                                directionNav: true,
                                                controlsContainer: ".flex-container" // the container that holds the flexslider
                                        });
                                });
                        });
    </script>
</body>
</html>