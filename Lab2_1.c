#include <stdio.h>
#include <stdlib.h>
int main()
{
    printf("Enter number :");
    int D, divider = 2;
    scanf("%d", &D);
    printf("Factoring Result is : ");
    if (D == 1 || D == -1)
    {
        printf("1");
        return 0;
    }
    else if (D == 0)
    {
        printf("0");
        return 0;
    }
    if (D < 0)
    {
        printf("-");
        D *= -1;
    }
    while (D >= 2)
    {
        if (D % divider == 0)
        {
            printf("%d", divider);
            D /= divider;
            divider == 2;
            if (D >= divider)
            {
                printf(" x ");
            }
        }
        else
            divider += 1;
    }

    printf("\n");
    system("pause") ;
    return 0;
}
