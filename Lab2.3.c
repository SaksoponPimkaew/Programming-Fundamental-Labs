#include <stdio.h>
#include <ctype.h>
#include <stdlib.h>

int main()
{
    int D;
    char k[0];
    scanf("%[^\n]",&k[0]);
    int check = isalpha(k[0]);
    D = atoi(k);
    if (check==1 || D<=0)
    {
        printf("ERROR");
        return 0;
    }
    for (int i = 1; i <= D; i++)
    {
        if (i==1 || i==D)
        {
            for (int i = 1; i <= D; i++)
            {
                printf("*");
            }
            printf("\n"); 
        }
        else
        {
            printf("*");
            for (int i = 1; i <= D-2; i++)
            {
                printf(" ");
            }
                printf("*");
                printf("\n");
        }
    }
    system("pause") ;
    return 0;
}