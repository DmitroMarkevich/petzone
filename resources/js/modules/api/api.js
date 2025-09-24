export const fetchData = async (url, data = {}, type = 'GET') => {
    try {
        const options = {
            method: type.toUpperCase(),
            headers: { 'Content-Type': 'application/json' },
        };

        if (type.toUpperCase() === 'GET' && Object.keys(data).length) {
            url += `?${new URLSearchParams(data)}`;
        } else if (type.toUpperCase() === 'POST') {
            options.body = JSON.stringify(data);
        }

        const response = await fetch(url, options);
        const json = await response.json();

        return json.success ? json.result : [];
    } catch (e) {
        console.error('Fetch failed:', e);
        return [];
    }
};
