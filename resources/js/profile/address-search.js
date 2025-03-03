$(document).ready(function () {
    const apiKey = "e69895428295483696ea428da1bf662b";
    const baseUrl = "https://api.geoapify.com/v1/geocode/autocomplete";
    const bannedKeywords = ["громада", "міська громада"];
    const ukraineAlphabet = /^[А-яіІїЇєЄёЁґҐ\s,.'-]+$/;

    const cityEditInput = $("#city-edit");
    const citySuggestionsList = $("#address-suggestions");

    function isUkrainian(text) {
        return ukraineAlphabet.test(text);
    }

    cityEditInput.on("input", function () {
        const searchText = cityEditInput.val().trim();

        if (searchText) {
            const url = `${baseUrl}?text=${encodeURIComponent(searchText)}&apiKey=${apiKey}&lang=uk&filter=countrycode:ua`;

            $.ajax({
                url: url,
                method: "GET",
                success: function ({features}) {
                    citySuggestionsList.empty();
                    const seenCities = new Set();

                    if (features?.length) {
                        features.forEach(({properties}) => {
                            const {city, name, region, state} = properties;
                            const cityName = city || name;
                            const regionName = region || state;

                            if (cityName && regionName &&
                                isUkrainian(cityName) &&
                                !bannedKeywords.some(keyword => cityName.toLowerCase().includes(keyword))) {

                                const cityIdentifier = `${cityName}, ${regionName}`;
                                if (!seenCities.has(cityIdentifier)) {
                                    seenCities.add(cityIdentifier);
                                    citySuggestionsList.append(`<li>${cityName}, ${regionName}</li>`);
                                }
                            }
                        });

                        if (seenCities.size > 0) {
                            citySuggestionsList.show();
                        } else {
                            citySuggestionsList.hide();
                        }

                        citySuggestionsList.find("li").on("click", function () {
                            cityEditInput.val($(this).text());
                            citySuggestionsList.hide();
                        });
                    } else {
                        citySuggestionsList.hide();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("API Request Failed:", status, error);
                    citySuggestionsList.hide();
                }
            });
        } else {
            citySuggestionsList.hide();
        }
    });

    $(document).on("click", function (event) {
        if (!$(event.target).closest("#city-edit, #address-suggestions").length) {
            citySuggestionsList.hide();
        }
    });
});
