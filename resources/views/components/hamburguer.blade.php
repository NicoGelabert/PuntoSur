<button 
    @click="mobileMenuOpen = !mobileMenuOpen" 
    class="block z-10"
>
    <div class="openbtn">
        <div class="openbtn-area"><span></span><span></span><span></span>
        </div>
    </div>
    
</button>

<script>
    document.querySelectorAll(".openbtn").forEach(function(btn) {
        btn.addEventListener("click", function() {
            this.classList.toggle("active");
        });
    });
</script>