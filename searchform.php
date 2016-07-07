<form  method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <fieldset>
        <label for="search"></label>
        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="输入搜索"/>
        <button type="submit">
            <i class="fa fa-search"></i>
        </button>
    </fieldset>
</form>