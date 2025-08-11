<li>
    <a href="/" class="{{ (request()->segment(1) == null) ? 'current' : '' }}"><span class="title">Home</span></a>
</li>
<li>
    <a href="/about-us" class="{{  (request()->segment(1) == 'about-us') ? 'current' : '' }}"><span class="title">About Us</span></a>
</li>
<li>
    <a href="/projects/listings" class="{{  request()->segment(1) == 'projects' ? 'current' : '' }}"><span class="title">Find Projects</span></a>
</li>
<li>
    <a href="/compare"><span class="title">Compare</span></a>
</li>
<li>
    <a href="/blogs" class="{{  request()->segment(1) == 'blogs' ? 'current' : '' }}"><span class="title">Blogs</span></a>
</li>
<li>
    <a href="/contact-us" class="{{  request()->segment(1) == 'contact-us' ? 'current' : '' }}"><span class="title">Contact Us</span></a>
</li>
