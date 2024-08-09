export const linksReform = {
    data() {
        return {
            excludedPaths: ['/sveden/', '/storage']
        }
    },
    methods: {
        checkPathname(pathname) {
            return this.excludedPaths.some(path => pathname.startsWith(path));
        },
        getDefaultLinks() {
            const links = document.querySelectorAll('a:not([href^="#"]):not([download])');
            return Array.from(links);
        },
        createReactiveLinks(links, hostname) {
            return links.filter(link => link.hostname === hostname).filter(link => !this.checkPathname(link.pathname));
        },
        createStaticLinks(links, hostname) {
            return links.filter(link => link.hostname !== hostname);
        }
    },
    mounted() {
        const hostname = window.location.hostname;
        const defaultLinks = Array.from(this.getDefaultLinks());

        const reactiveLinks = this.createReactiveLinks(defaultLinks, hostname);
        const staticLinks = this.createStaticLinks(defaultLinks, hostname);

        reactiveLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const url = link.getAttribute('href');
                this.$inertia.visit(url);
            });
        });

    }
};