/**
 * Resolves the image URL, using a placeholder if the provided URL is empty or invalid.
 * @param imageUrl - The URL of the image.
 * @param placeholderImage - The URL of the placeholder image.
 * @returns The resolved image URL.
 */
export const resolveImageUrl = (imageUrl: string, placeholderImage: string): string => {
    return imageUrl ? imageUrl : placeholderImage;
};

/**
 * Ensures the image URL is a full URL.
 * If the URL is relative, prepend the base URL.
 *
 * @param {string} url - The image URL.
 * @param {string} baseUrl - The base URL to prepend.
 * @returns {string} - The full image URL.
 */
export function getFullImageUrl(url: string, baseUrl: string): string {
    if (!url) {
        return '';
    }
    // Check if the URL is already a full URL
    try {
        new URL(url);
        return url; // URL is already absolute
    } catch {
        // URL is relative, prepend base URL
        return `${baseUrl}/${url.replace(/^\/+/, '')}`;
    }
}