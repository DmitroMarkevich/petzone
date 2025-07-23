/**
 * Fetch suggestions via AJAX with async/await.
 */
export const fetchData = async (url, data = {}, type = 'GET') => {
    try {
        const response = await $.ajax({ url, type, data });
        return response.success ? response.result : [];
    } catch (error) {
        console.error(`Error fetching data from ${url}:`, error);
        return [];
    }
};
