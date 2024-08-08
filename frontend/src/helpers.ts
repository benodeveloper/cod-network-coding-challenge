/**
 * Resolves the image URL, using a placeholder if the provided URL is empty or invalid.
 * @param imageUrl - The URL of the image.
 * @param placeholderImage - The URL of the placeholder image.
 * @returns The resolved image URL.
 */
export const resolveImageUrl = (imageUrl: string, placeholderImage: string): string => {
    return imageUrl ? imageUrl : placeholderImage;
};